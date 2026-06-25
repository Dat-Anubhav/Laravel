<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;


class UserForm
{
    public static function configure(Schema $schema): Schema
{
    return $schema
        ->components([
            TextInput::make("name")
                ->required(),
            TextInput::make("email")
                ->email()
                ->required()
                ->unique(ignoreRecord: true),
            TextInput::make("password")
                ->password()
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create'),
            Select::make('type')
                ->options([
                    'admin' => 'Admin (Super Admin)',
                    'manager' => 'Manager',
                    'user' => 'User',
                  ])
                ->required()
                ->default('user'),
            Select::make('teams')
                ->relationship('teams', 'name')
                ->multiple()
                ->preload(),
        ]);
}

}
