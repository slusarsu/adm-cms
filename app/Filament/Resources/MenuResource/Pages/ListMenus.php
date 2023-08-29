<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources\MenuResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Str;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

//    protected function getTitle(): string
//    {
//        return trans('adm/dashboard.menu');
//    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
