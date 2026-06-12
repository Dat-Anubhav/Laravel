<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $fillable=["title","slug","category_id","color","image",
    "body","published","published_at"];

    protected $casts = [
        "published" => "boolean",
        "published_at" => "date"
    ];

    // Establish relation with the category class (category model)
    public function category(){
        return $this->belongsTo(Category::class);
    } 

    // Establish relation with the tag class (Tags model)
    public function tags(){
        return $this->belongsToMany(Tag::class, "post_tag");
    } 
}

