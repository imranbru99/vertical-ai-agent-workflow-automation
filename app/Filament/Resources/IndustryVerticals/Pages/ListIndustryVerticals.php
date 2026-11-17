<?php

namespace App\Filament\Resources\IndustryVerticals\Pages;

use App\Filament\Resources\IndustryVerticals\IndustryVerticalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIndustryVerticals extends ListRecords
{
    protected static string $resource = IndustryVerticalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
