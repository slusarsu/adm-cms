<?php

namespace App\Adm\Services;

use App\Models\Menu;

class MenuService
{
    public static function bySlug(string $slug)
    {
       return Menu::query()
           ->where('slug', $slug)
           ->active()
           ->locale()
           ->with('menu_items')->first();
    }

    public static function byPosition(string $position)
    {
        return Menu::query()
            ->where('position', $position)
            ->active()
            ->locale()
            ->with('menu_items')->first();
    }

    public static function allByPosition(string $position)
    {
        return Menu::query()
            ->where('position', $position)
            ->active()
            ->locale()
            ->with('menu_items')
            ->get();
    }
}
