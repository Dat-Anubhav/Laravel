<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->disk('public'),
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('slug'),
                TextColumn::make('category.name'),
                ColorColumn::make('color'),
                TextColumn::make('created_at')
                    ->label('created_at')
                    ->dateTime()
                    ->sortable(), // arrange them in an ascending or descending order
            ])->defaultSort('title', 'asc')

            ->filters([

                Filter::make('created_at')
                    ->label('Creation date')
                    ->schema([
                        DatePicker::make('created_at')
                            ->label('Select the date'),
                    ])
                    // Query method to make the filter work
                    ->query(function ($query, $data) {
                        return $query
                            ->when($data['created_at'], function ($q, $date) {
                                $q->whereDate('created_at', $date);
                            });
                    }),
                    //Adding select category feature too in filter
                SelectFilter::make('category_id')
                    ->label('Select Category')
                    ->relationship('category', 'name')
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make()
                    ->url(fn (\App\Models\post $record): string => route('filament.admin.resources.posts.edit', $record)),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
