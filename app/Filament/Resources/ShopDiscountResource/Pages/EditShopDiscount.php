<?php

namespace App\Filament\Resources\ShopDiscountResource\Pages;

use App\Filament\Resources\ShopDiscountResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShopDiscount extends EditRecord
{
    protected static string $resource = ShopDiscountResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
