<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'title',
        'slug',
        'content',
        'category_id',
        'user_id',
        'published_at',
    ];

    /**
     * A post belongs to a specific author (User).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likedByUsers()
{
    return $this->belongsToMany(User::class)->withTimestamps();
}

/**
     * Get the category that owns the post.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}

