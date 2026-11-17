<?php

namespace App\Filament\Resources\VerticalAgents;

use App\Filament\Resources\VerticalAgents\Pages\CreateVerticalAgent;
use App\Filament\Resources\VerticalAgents\Pages\EditVerticalAgent;
use App\Filament\Resources\VerticalAgents\Pages\ListVerticalAgents;
use App\Filament\Resources\VerticalAgents\Schemas\VerticalAgentForm;
use App\Filament\Resources\VerticalAgents\Tables\VerticalAgentsTable;
use App\Models\VerticalAgent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VerticalAgentResource extends Resource
{
    protected static ?string $model = VerticalAgent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return VerticalAgentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VerticalAgentsTable::configure($table);
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
            'index' => ListVerticalAgents::route('/'),
            'create' => CreateVerticalAgent::route('/create'),
            'edit' => EditVerticalAgent::route('/{record}/edit'),
        ];
    }
}
