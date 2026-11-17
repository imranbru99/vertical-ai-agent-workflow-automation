<?php

namespace App\Filament\Resources\IndustryVerticals;

use App\Filament\Resources\IndustryVerticals\Pages\CreateIndustryVertical;
use App\Filament\Resources\IndustryVerticals\Pages\EditIndustryVertical;
use App\Filament\Resources\IndustryVerticals\Pages\ListIndustryVerticals;
use App\Filament\Resources\IndustryVerticals\Schemas\IndustryVerticalForm;
use App\Filament\Resources\IndustryVerticals\Tables\IndustryVerticalsTable;
use App\Models\IndustryVertical;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class IndustryVerticalResource extends Resource
{
    protected static ?string $model = IndustryVertical::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return IndustryVerticalForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IndustryVerticalsTable::configure($table);
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
            'index' => ListIndustryVerticals::route('/'),
            'create' => CreateIndustryVertical::route('/create'),
            'edit' => EditIndustryVertical::route('/{record}/edit'),
        ];
    }
}
