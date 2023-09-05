<?php

namespace App\Filament\Resources\ShopCustomerResource\Pages;

use App\Filament\Resources\ShopCustomerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShopCustomers extends ListRecords
{
    protected static string $resource = ShopCustomerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
