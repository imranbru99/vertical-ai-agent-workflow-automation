<?php

namespace App\Filament\Resources\AutomationRuns\Schemas;

use App\Enums\AutomationRunStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AutomationRunForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('workflow_id')->relationship('workflow', 'name')->required()->searchable()->preload(),
                Select::make('vertical_agent_id')->relationship('agent', 'name')->searchable()->preload(),
                Select::make('triggered_by')->relationship('triggeredBy', 'name')->searchable()->preload(),
                Select::make('status')->options(AutomationRunStatus::options())->required(),
                TextInput::make('duration_seconds')->numeric(),
                TextInput::make('minutes_saved')->numeric(),
                Textarea::make('error_message')->rows(3)->columnSpanFull(),
            ]);
    }
}
