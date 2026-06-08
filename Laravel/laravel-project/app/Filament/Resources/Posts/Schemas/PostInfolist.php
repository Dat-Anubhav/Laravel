<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class PostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Post Details')
                    ->tabs([
                        // Tab 1: Visual & Core Content
                        Tabs\Tab::make('Content')
                            ->icon('heroicon-m-document-text')
                            ->schema([
                                ImageEntry::make('image')->disk('public')
                                    ->placeholder('-'),
                                TextEntry::make('title')
                                ->badge(),
                                TextEntry::make('content')
                                    ->columnSpanFull(),
                            ]),

                        // Tab 2: Categorization & Ownership
                        Tabs\Tab::make('Metadata')
                            ->icon('heroicon-m-information-circle')
                            ->schema([
                                TextEntry::make('slug'),
                                TextEntry::make('category.name')
                                    ->label('Category')
                                    ->icon('heroicon-o-document-text')
                                    ->badge()
                                    ->weight('bold')
                                    ->placeholder('Uncategorized'),
                                TextEntry::make('user.name')
                                    ->label('Author')
                                    ->weight('bold')
                                    ->color('primary')
                            ]),

                        // Tab 3: Temporal Data
                        Tabs\Tab::make('History')
                            ->icon('heroicon-m-clock')
                            ->schema([
                                TextEntry::make('published_at')
                                    ->dateTime()
                                    ->placeholder('Not Published'),
                                TextEntry::make('created_at')
                                    ->dateTime(),
                                TextEntry::make('updated_at')
                                    ->dateTime(),
                            ]),
                    ])
                    ->columnSpanFull(), // 🌟 Ensures tabs take up the whole width
            ]);
    }
}
