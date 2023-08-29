<?php

namespace App\Filament\Resources\AdmFormResource\Pages;

use App\Filament\Resources\AdmFormResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdmForm extends EditRecord
{
    protected static string $resource = AdmFormResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
