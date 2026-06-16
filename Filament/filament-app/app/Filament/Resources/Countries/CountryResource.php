<?php

namespace App\Filament\Resources\Countries;

use App\Filament\Resources\Countries\Pages\CreateCountry;
use App\Filament\Resources\Countries\Pages\EditCountry;
use App\Filament\Resources\Countries\Pages\ListCountries;
use App\Filament\Resources\Countries\Schemas\CountryForm;
use App\Filament\Resources\Countries\Tables\CountriesTable;
use App\Models\Country;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    // Setting Manage countries icon to flag
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Flag;

    
    protected static ?string $recordTitleAttribute = 'name';

    // Adding countries into the Location navigation sidebar
    protected static string|\UnitEnum|null $navigationGroup = 'Locations';

    // Assigning a number to country in a navigation sidebar to display them in a order
    protected static ?int $navigationSort = 3;

    // Assiging a label
    protected static ?string $navigationLabel = 'Manage Countries';

    //CREATING A COUNT BADGE
    public static function getNavigationBadge():?string{
        return Country::count();
    }

    //Changing color of the above created badge
    public static function getNavigationBadgeColor():string|array|null{
        return "success";
    }

    public static function form(Schema $schema): Schema
    {
        return CountryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CountriesTable::configure($table);
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
            'index' => ListCountries::route('/'),
            'create' => CreateCountry::route('/create'),
            'edit' => EditCountry::route('/{record}/edit'),
        ];
    }
}
