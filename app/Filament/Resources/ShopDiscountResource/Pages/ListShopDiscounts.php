<?php

namespace App\Filament\Resources\ShopDiscountResource\Pages;

use App\Filament\Resources\ShopDiscountResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShopDiscounts extends ListRecords
{
    protected static string $resource = ShopDiscountResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
