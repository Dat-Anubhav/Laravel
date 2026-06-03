<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $fillable=["title","slug","category_id","color","image",
    "body","tags","published","published_at"];

    protected $casts = [
        "tags" => "array",
        "published" => "boolean",
        "published_at" => "date"
    ];

    // Establish relation with the category class (category model)
    public function category(){
        return $this->belongsTo(Category::class);
    } 
}

