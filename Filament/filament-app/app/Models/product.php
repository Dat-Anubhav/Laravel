<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Team;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class product extends Model
{
    protected $fillable = [
        "name",
        "sku",
        "description",
        "price",
        "stock",
        "image",
        "is_active",
        "is_featured"
    ];

    public function team(): BelongsTo
{
    return $this->belongsTo(Team::class);
}
}
