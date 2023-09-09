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
        $images = Storage::disk('asset')->allFiles('images/random');
        $rand = rand(1,count($images))-1 ?? 0;
        return '/'.$images[$rand] ?? '';
    }

    public static function getTemplateName(string $viewFolderPath, string $defaultName, string $templateNeeded): string
    {
        $template = $templateNeeded;

        $templates = self::getViewBladeFileNames($viewFolderPath);

        if(!in_array($template, $templates)) {
            $template = $defaultName;
        }

        if(!in_array($defaultName, $templates)) {
            abort(404);
        }

        return $template;
    }
}
