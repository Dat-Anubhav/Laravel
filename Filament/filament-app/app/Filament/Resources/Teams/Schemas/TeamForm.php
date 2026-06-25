<?php

namespace App\Filament\Resources\Teams\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Illuminate\Support\Str;


class TeamForm
{
    public static function configure(Schema $schema): Schema
{
    return $schema
        ->components([
            TextInput::make('name')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
            TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true),
            Select::make('members')
                ->relationship('members', 'name')
                ->multiple()
                ->preload(),
        ]);
}

}
