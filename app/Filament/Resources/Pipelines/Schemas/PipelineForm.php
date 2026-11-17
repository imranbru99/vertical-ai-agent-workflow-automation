<?php

namespace App\Filament\Resources\Pipelines\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PipelineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                TextInput::make('slug')->required()->unique(ignoreRecord: true),
                Select::make('industry_vertical_id')->relationship('industryVertical', 'name')->searchable()->preload(),
                TextInput::make('stage')->required(),
                TextInput::make('items_in_flight')->numeric()->default(0),
                Toggle::make('is_active')->default(true),
                Textarea::make('description')->rows(3)->columnSpanFull(),
            ]);
    }
}
