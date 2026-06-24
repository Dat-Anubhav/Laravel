<?php

namespace App\Filament\Pages\Tenancy;

use App\Models\Team;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema; // <-- Note the Filament v5 Schema import
use Filament\Pages\Tenancy\RegisterTenant;
use Illuminate\Support\Str;

class RegisterTeam extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register team';
    }

    public function form(Schema $schema): Schema // <-- Note: Schema is used here
    {
        return $schema
            ->components([ // <-- Note: in Filament v5, we use components() instead of schema()
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->unique(Team::class, 'slug'),
            ]);
    }

    protected function handleRegistration(array $data): Team
    {
        // 1. Create the new team
        $team = Team::create($data);

        // 2. Associate the logged-in user with the new team (via the pivot table)
        $team->members()->attach(auth()->user());

        return $team;
    }
}
