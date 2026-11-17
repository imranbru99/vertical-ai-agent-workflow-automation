<?php

namespace App\Filament\Resources\Workflows\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WorkflowsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('status')->badge(),
                TextColumn::make('module.name')->label('Module'),
                TextColumn::make('industryVertical.name')->label('Vertical')->toggleable(),
                TextColumn::make('runs_count')->label('Runs')->sortable(),
                TextColumn::make('avg_minutes_saved')->label('Min saved'),
                IconColumn::make('is_published')->boolean(),
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
