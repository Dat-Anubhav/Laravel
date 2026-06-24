<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Team;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    protected $fillable=["name","slug"];

    public function posts(){
    return $this->HasMany(Post::class);
}

public function team(): BelongsTo
{
    return $this->belongsTo(Team::class);
}
}

