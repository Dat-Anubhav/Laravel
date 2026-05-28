<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password','username', 'bio', 'image'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail
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

    /**
     * A user can write many posts.
     */
    public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Post::class);
    }

    // Posts this user has liked
public function likedPosts()
{
    return $this->belongsToMany(Post::class)->withTimestamps();
}

// Authors this user is following
public function followings()
{
    return $this->belongsToMany(User::class, 'followers', 'follower_id', 'leader_id')->withTimestamps();
}

// Users that follow this author
public function followers()
{
    return $this->belongsToMany(User::class, 'followers', 'leader_id', 'follower_id')->withTimestamps();
}
}
