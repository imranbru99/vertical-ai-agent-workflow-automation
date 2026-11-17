<?php

namespace App\Filament\Resources\Workflows\Schemas;

use App\Enums\WorkflowStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class WorkflowForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->maxLength(180),
                TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(180),
                Select::make('industry_vertical_id')->relationship('industryVertical', 'name')->searchable()->preload(),
                Select::make('module_id')->relationship('module', 'name')->searchable()->preload(),
                Select::make('owner_id')->relationship('owner', 'name')->searchable()->preload(),
                Select::make('status')->options(WorkflowStatus::options())->required(),
                TextInput::make('trigger_type')->default('manual')->required(),
                TextInput::make('avg_minutes_saved')->numeric()->suffix('min'),
                TextInput::make('steps_count')->numeric()->default(0),
                Toggle::make('is_published')->default(false),
                Textarea::make('description')->rows(4)->columnSpanFull(),
            ]);
    }
}
