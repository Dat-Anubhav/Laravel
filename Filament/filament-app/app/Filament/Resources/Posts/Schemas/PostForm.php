<?php

//WIZARD FORM OR MULTI STEP FORM:-


namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Category;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    
                    // STEP 1: Core Content Creation
                    Wizard\Step::make('Order Content')
                        ->description('Write the core post data')
                        
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->maxLength(255),
                                
                            TextInput::make('slug')
                                ->required()
                                ->maxLength(255),
                                
                            MarkdownEditor::make('body')
                                ->required(),
                        ]),

                    // STEP 2: Media Management
                    Wizard\Step::make('Media Upload')
                        ->description('Add a thumbnail image')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('posts'),
                        ]),

                    // STEP 3: Metadata & Publishing Settings
                    Wizard\Step::make('Publishing Settings')
                        ->description('Control visibility and meta status')
                        ->icon('heroicon-o-rocket-launch')
                        ->schema([
                            Select::make('category_id')
                                ->label('Category')
                                ->options(Category::all()->pluck('name', 'id'))
                                ->required(),

                            ColorPicker::make('color')
                                ->label('Theme Color'),

                            TagsInput::make('tags')
                                ->placeholder('Add new tag...'),

                            Checkbox::make('published')
                                ->label('Publish immediately to live site'),

                            DatePicker::make('published_at')
                                ->label('Publication Date'),
                        ]),
                ])
                ->columnSpanFull() // Ensures the stepper layout stretches beautifully across the page
                ->skippable(),      // Optional: Allows users to click on any step name to navigate freely if validation passes
            ]);
    }
}
/* simple singLe view form


namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Category;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Unique;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // LEFT SIDE COLUMN (Spans 2 columns)
                Group::make()
                    ->schema([
                        Section::make("Fields")
                            ->description("Fill all the fields")
                            ->icon('heroicon-o-rocket-launch')
                            ->schema([
                                // Sub-grid to place title/slug and category/color side-by-side
                                Group::make()
                                    ->schema([
                                        TextInput::make("title")
                                            ->rules(["required","min:3","max:10"]),
                                        TextInput::make("slug")
                                            ->unique()->validationMessages(["unique"=>"slug should be unique."])
                                            ->required(),
                                            
                                        Select::make("category_id")
                                            ->label("Category")
                                            ->options(Category::all()->pluck("name", "id")),
                                            //->required(),
                                        ColorPicker::make("color")
                                            ->label("Theme Color"),
                                    ])
                                    ->columns(2),
                                
                                MarkdownEditor::make("body")
                                    ->required()
                                    ->minHeight('120px'),
                            ]),
                    ])
                    ->columnSpan(2),

                // RIGHT SIDE COLUMN (Spans 1 column)
                Group::make()
                    ->schema([
                        Section::make("Image Upload")
                            ->schema([
                                FileUpload::make("image")
                                    ->disk("public")
                                    ->directory("posts"),
                            ]),

                        Section::make("Meta")
                            ->schema([
                                TagsInput::make("tags"),
                                Checkbox::make("published")
                                    ->label("Visible on site"),
                                DatePicker::make("published_at")
                                    ->label("Publish Date"),
                            ]),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3); // Base split for the grid canvas
    }
}
*/