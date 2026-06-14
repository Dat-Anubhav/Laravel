<?php

namespace App\Filament\Resources\Cities\Schemas;

use App\Models\Country;
use App\Models\State;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Database\Eloquent\Builder;

class CityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make("country_id")
                    ->label("Country")
                    ->options(Country::pluck('name', 'id'))
                    ->live()
                    ->dehydrated(false)
                    ->afterStateUpdated(fn (Set $set) => $set('state_id', null))
                    ->afterStateHydrated(function (Select $component, $record) {
                        if ($record) {
                            $component->state($record->state?->country_id);
                        }
                    })
                    ->required(),

                Select::make("state_id")
                    ->relationship('state', 'name', fn (Builder $query, Get $get) => $query->where('country_id', $get('country_id')))
                    ->required(),

                TextInput::make("name")
                    ->required(),
            ]);
    }
}

