<?php

namespace App\Filament\Resources\IndustryVerticals\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class IndustryVerticalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                TextInput::make('slug')->required()->unique(ignoreRecord: true),
                TextInput::make('accent_color')->default('#0F766E'),
                TextInput::make('typical_roi_percent')->numeric()->suffix('%'),
                Toggle::make('is_active')->default(true),
                Textarea::make('description')->rows(4)->columnSpanFull(),
            ]);
    }
}
