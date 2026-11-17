<?php

namespace App\Filament\Resources\VerticalAgents\Pages;

use App\Filament\Resources\VerticalAgents\VerticalAgentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVerticalAgent extends EditRecord
{
    protected static string $resource = VerticalAgentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
