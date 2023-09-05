<?php

namespace App\Filament\Resources\ShopSessionResource\Pages;

use App\Filament\Resources\ShopSessionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShopSession extends EditRecord
{
    protected static string $resource = ShopSessionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
