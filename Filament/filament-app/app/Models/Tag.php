<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ["name"];

    // Establish relation with the tag class (Tags model)
    public function posts(){
        return $this->belongsToMany(Post::class, "post_tag");
    } 
}
