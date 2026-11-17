<?php

namespace App\Filament\Resources\VerticalAgents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VerticalAgentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('specialty')->badge()->color('primary'),
                TextColumn::make('status')->badge(),
                TextColumn::make('model_provider')->label('Provider'),
                TextColumn::make('tasks_completed')->label('Tasks'),
                TextColumn::make('success_rate')->suffix('%'),
                IconColumn::make('is_enabled')->boolean(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
