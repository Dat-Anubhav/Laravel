<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step; // Import the Step component cleanly
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;
use Filament\Schemas\Schema;
use Filament\Actions\Action;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    
                    // STEP 1: Product Info (From Image 1)
                    Step::make("Product Info")
                        ->schema([
                            Group::make()
                                ->schema([
                                    TextInput::make("name")
                                        ->required(),
                                    TextInput::make("sku")
                                        ->label('SKU'),
                                ])->columns(2),
                                
                            MarkdownEditor::make("description"),
                        ]),

                    // STEP 2: Pricing & Stock (From Image 1 & 2)
                    Step::make("Pricing & Stock")
                        ->schema([
                            Group::make()
                                ->schema([
                                    TextInput::make("price")
                                        ->numeric()
                                        ->required(),
                                    TextInput::make("stock")
                                        ->numeric()
                                        ->required(),
                                ])->columns(2),
                        ]),

                    // STEP 3: Media & Status (From Image 2)
                    Step::make("Media & Status")
                        ->schema([
                            FileUpload::make("image")
                                ->disk("public")
                                ->directory("products"),
                                
                            Checkbox::make("is_active")
                                ->label('Active'),
                                
                            Checkbox::make("is_featured")
                                ->label('Featured'),
                        ]),

                ])->columnSpanFull()
                ->skippable() // can see the next step without completing the first one
                ->submitAction(
                    Action::make("save")
                    ->label("save product")
                    ->button()
                    ->color("primary")
                    ->submit("save")

                )

            ]);
    }
}