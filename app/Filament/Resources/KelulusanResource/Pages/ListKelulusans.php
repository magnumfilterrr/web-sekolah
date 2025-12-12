<?php

namespace App\Filament\Resources\KelulusanResource\Pages;

use App\Filament\Resources\KelulusanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKelulusans extends ListRecords
{
    protected static string $resource = KelulusanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
