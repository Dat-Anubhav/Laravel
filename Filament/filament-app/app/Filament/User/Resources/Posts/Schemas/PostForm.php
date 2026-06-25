<?php

namespace App\Filament\User\Resources\Posts\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('category_id')
                    ->required()
                    ->numeric(),
                TextInput::make('color'),
                FileUpload::make('image')
                    ->image(),
                Textarea::make('body')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('tags')
                    ->required(),
                Toggle::make('published')
                    ->required(),
                DatePicker::make('published_at'),
                Select::make('team_id')
                    ->relationship('team', 'name'),
            ]);
    }
}
