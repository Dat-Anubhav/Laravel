<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $fillable = ['name', 'slug'];

    // Relate to users who belong to this team
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    // Scoped entities
    public function posts(): HasMany
    {
        return $this->hasMany(post::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(product::class);
    }
}
