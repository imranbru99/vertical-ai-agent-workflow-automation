<?php

namespace App\Filament\Resources\IndustryVerticals\Pages;

use App\Filament\Resources\IndustryVerticals\IndustryVerticalResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditIndustryVertical extends EditRecord
{
    protected static string $resource = IndustryVerticalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
