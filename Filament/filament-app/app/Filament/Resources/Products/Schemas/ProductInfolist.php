<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ONE SINGLE ROOT TABS CONTAINER
                Tabs::make("Product Details")
                    ->tabs([
                        
                        // TAB 1: PRODUCT INFO
                        Tab::make("Product info")
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Section::make("General Specifications")
                                    ->schema([
                                        TextEntry::make("id")
                                            ->label("Product ID")
                                            ->weight("bold")
                                            ->color("primary"),

                                        TextEntry::make("name")
                                            ->label("Product name")
                                            ->weight("bold")
                                            ->color("primary"),

                                        TextEntry::make("sku")
                                            ->label("Product SKU")
                                            ->weight("bold")
                                            ->badge()
                                            ->color("success"),

                                        TextEntry::make("description")
                                            ->label("Product Description")
                                            ->weight("bold")
                                            ->markdown()
                                            ->columnSpanFull(),

                                        TextEntry::make("created_at")
                                            ->label("Product Creation Date")
                                            ->weight("bold")
                                            ->color("primary")
                                            ->date("d/m/Y"),
                                    ])
                                    ->columns(3),
                            ]),

                        // TAB 2: PRICING & STOCKS
                        Tab::make("Pricing & Stocks")
                            ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                Section::make("Inventory Data")
                                    ->schema([
                                        TextEntry::make("price")
                                            ->label("Product Price")
                                            ->weight("bold")
                                            ->badge()
                                            ->icon('heroicon-o-currency-dollar')
                                            ->color("success"),

                                        TextEntry::make("stock")
                                            ->label("Product stock")
                                            ->weight("bold")
                                            ->badge()
                                            ->color("primary"),
                                    ])
                                    ->columns(2),
                            ]),

                        // TAB 3: MEDIA & STATUS
                        Tab::make("Media & Status")
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Section::make("Media Assets & Visibility")
                                    ->schema([
                                        ImageEntry::make("image")
                                            ->label("Product Image")
                                            ->disk("public"),
                                            
                                        IconEntry::make("is_active")
                                            ->label("Is Active?")
                                            ->boolean(),
                                    ])
                                    ->columns(2),
                            ]),

                    ])
                    ->columnSpanFull(), // Stretches the unified tab bar completely across the layout canvas
            ]);
    }
}