<?php

namespace App\Filament\Resources\DespesaResource\Pages;

use App\Filament\Resources\DespesaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDespesa extends ViewRecord
{
    protected static string $resource = DespesaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
