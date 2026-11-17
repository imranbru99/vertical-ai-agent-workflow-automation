<?php

namespace App\Filament\Resources\AutomationRuns\Pages;

use App\Filament\Resources\AutomationRuns\AutomationRunResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAutomationRun extends EditRecord
{
    protected static string $resource = AutomationRunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
