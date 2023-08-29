<?php

namespace App\Filament\Resources\ChunkResource\Pages;

use App\Filament\Resources\ChunkResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChunks extends ListRecords
{
    protected static string $resource = ChunkResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
