<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;


#[Fillable(['name', 'email', 'password', 'country_id', 'state_id', 'city_id', 'type'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable Implements HasTenants
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function country()
    {
        return $this->belongsTo(City::class);
    }

    public function isAdmin()
    {
        return $this->type === 'admin';
    }

    public function isManager()
    {
        return $this->type === 'manager';
    }

    public function isUser()
    {
        return $this->type === 'user';
    }

    public function canAccessPanel(Panel $panel): bool
    {

        // Admin panel access: only admin allowed
        if ($panel->getId() === 'admin') {
            return $this->type === 'admin';
        }

        // //Admin panel access: only admin allowed
        if ($panel->getId() === 'manager') {
            return $this->type === 'manager';
        }

        // user panel access: along with normal users and manager, admin can also login as user as user

        if ($panel->getId() === 'user') {
            return $this->type === 'user' || $this->type === 'admin' || $this->type === 'manager';
        }
    }

    //multi tenancy

    // Define many-to-many relationship with the Team model
public function teams(): BelongsToMany
{
    return $this->belongsToMany(Team::class);
}

// Return the list of teams (tenants) this user belongs to
public function getTenants(Panel $panel): array | Collection
{
    return $this->teams;
}

// Determine if the user is allowed to access a specific tenant
public function canAccessTenant(Model $tenant): bool
{
    return $this->teams()->where('teams.id', $tenant->id)->exists();
}

}
