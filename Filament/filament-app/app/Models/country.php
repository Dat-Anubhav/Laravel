<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    protected $fillable=["name"];

    public function states(){
        return $this->hasMany(State::class);
    }

    public function city(){
        return $this->hasMany(City::class);
    }
}
