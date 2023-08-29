<?php

namespace App\Adm\Services;

use Illuminate\Support\Facades\Storage;

class AdmService
{
    public static function getViewBladeFileNames(string $paths): array
    {
        $files = Storage::disk('views')->files($paths);
        $templates = [];
        foreach ($files as $item) {
            $itemArr = explode('/', $item);
            $last = end($itemArr);
            $result = str_replace('.blade.php','',$last);
            $templates[$result] = $result;
        }

        return $templates;
    }

    public static function imageRandom(): string
    {
        if(!siteSetting()->get('showRandomImages')) {
            return '';
        }

        $images = Storage::disk('asset')->allFiles('images/random');
        $rand = rand(1,count($images))-1 ?? 0;
        return '/'.$images[$rand] ?? '';
    }
}
