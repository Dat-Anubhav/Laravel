<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

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

    public function likes()
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

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at','DESC');
    }

    /**
     * Plain-text preview for listings (markdown stripped).
     */
    protected function excerpt(): Attribute
    {
        return Attribute::get(function (): string {
            $plain = strip_tags(Str::markdown($this->content));
            $plain = preg_replace('/\s+/', ' ', $plain);

            return Str::limit(trim($plain), 190);
        });
    }
}
