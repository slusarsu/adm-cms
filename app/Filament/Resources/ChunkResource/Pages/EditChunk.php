<?php

namespace App\Filament\Resources\ChunkResource\Pages;

use App\Filament\Resources\ChunkResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChunk extends EditRecord
{
    protected static string $resource = ChunkResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
