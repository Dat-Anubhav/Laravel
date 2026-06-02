<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;


class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make("title"),
                TextInput::make("slug"),
                Select::make("category_id")->options(["one"=>"Category One", "two"=>"Category Two"])
                //In Filament, the options() method expects either an associative array or a callback function that returns an array. 
                // if you are passing "one" and "two" as separate string arguments, which will cause a PHP error.
            ]);
    }
}
