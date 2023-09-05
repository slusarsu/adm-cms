<?php

namespace App\Filament\Resources\ShopSessionResource\Pages;

use App\Filament\Resources\ShopSessionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShopSessions extends ListRecords
{
    protected static string $resource = ShopSessionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
