<?php

namespace App\Filament\Widgets;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class UserNewRegisteredWidget extends TableWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 4;
    public function table(Table $table): Table
    {
        return $table
            ->query(function (): Builder {
                $startDate = $this->filters['startDate'] ?? null;
                $endDate = $this->filters['endDate'] ?? null;

                return User::query()
                    ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                    ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
                    ->latest()
                    ->take(5);
            })
            ->columns([
                TextColumn::make("id"),
                TextColumn::make("name"),
                TextColumn::make("email"),
                TextColumn::make("created_at")

            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
