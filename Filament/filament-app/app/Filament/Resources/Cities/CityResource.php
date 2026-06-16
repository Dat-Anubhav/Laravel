<?php

namespace App\Filament\Resources\Cities;

use App\Filament\Resources\Cities\Pages\CreateCity;
use App\Filament\Resources\Cities\Pages\EditCity;
use App\Filament\Resources\Cities\Pages\ListCities;
use App\Filament\Resources\Cities\Schemas\CityForm;
use App\Filament\Resources\Cities\Tables\CitiesTable;
use App\Models\City;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::MapPin;

    protected static ?string $recordTitleAttribute = 'name';

    // Adding cities to Locations navigation sidebar
    protected static string|\UnitEnum|null $navigationGroup = 'Locations';

    //Adding number to city so that its be in an order in the navigation sidebar
    protected static ?int $navigationSort = 1;

    //Assiging navigation Label
    protected static ?string $navigationLabel = 'Manage Cities';

     //CREATING A COUNT BADGE
    public static function getNavigationBadge():?string{
        return City::count();
    }

    //Changing color of the above created badge
    public static function getNavigationBadgeColor():string|array|null{
        return "success";
    }

    public static function form(Schema $schema): Schema
    {
        return CityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CitiesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCities::route('/'),
            'create' => CreateCity::route('/create'),
            'edit' => EditCity::route('/{record}/edit'),
        ];
    }
}
