<?php

namespace App\Filament\Resources\VerticalAgents\Pages;

use App\Filament\Resources\VerticalAgents\VerticalAgentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVerticalAgents extends ListRecords
{
    protected static string $resource = VerticalAgentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
