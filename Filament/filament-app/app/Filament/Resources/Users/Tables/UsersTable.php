<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make("name")
                ->searchable(),
            TextColumn::make("email")
                ->searchable(),
            TextColumn::make("type")
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'admin' => 'danger',
                    'manager' => 'warning',
                    'user' => 'success',
                    default => 'gray',
                })
                ->searchable(),
            TextColumn::make("teams.name")
                ->badge()
                ->color('info')
                ->label('Companies/Teams'),
        ])
        ->filters([
            //
        ])
        ->recordActions([
            EditAction::make(),
        ])
        ->toolbarActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ]);
}

}
