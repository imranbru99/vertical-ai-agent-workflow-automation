<?php

namespace App\Filament\Resources\VerticalAgents\Schemas;

use App\Enums\AgentStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class VerticalAgentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                TextInput::make('slug')->required()->unique(ignoreRecord: true),
                TextInput::make('specialty')->required(),
                Select::make('industry_vertical_id')->relationship('industryVertical', 'name')->searchable()->preload(),
                Select::make('workflow_id')->relationship('workflow', 'name')->searchable()->preload(),
                Select::make('status')->options(AgentStatus::options())->required(),
                TextInput::make('model_provider')->default('openai'),
                TextInput::make('model_name')->default('gpt-4.1'),
                TextInput::make('success_rate')->numeric()->suffix('%'),
                Toggle::make('is_enabled')->default(true),
                Textarea::make('system_prompt')->rows(5)->columnSpanFull(),
            ]);
    }
}
