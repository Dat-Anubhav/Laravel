<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Schema;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    public function filtersForm(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Global Date Filters')
                    ->schema([
                        DatePicker::make('startDate')
                            ->label('Start Date')
                            ->maxDate(now()),
                        DatePicker::make('endDate')
                            ->label('End Date')
                            ->maxDate(now()),
                    ])
                    ->columns(2)
                    ->columnSpan("full"),
            ]);
    }
}