<?php

namespace App\Filament\Resources\AutomationRuns\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AutomationRunsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('workflow.name')->searchable(),
                TextColumn::make('agent.name')->label('Agent'),
                TextColumn::make('status')->badge(),
                TextColumn::make('minutes_saved')->label('Min saved'),
                TextColumn::make('duration_seconds')->label('Duration (s)'),
                TextColumn::make('started_at')->dateTime()->since(),
            ])
            ->defaultSort('id', 'desc')
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
