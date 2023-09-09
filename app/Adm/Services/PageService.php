<?php

namespace App\Adm\Services;

use App\Models\Page;
use Illuminate\Support\Facades\Storage;

class PageService
{
    public static function getListOfPageTemplates(): array
    {
        return AdmService::getViewBladeFileNames('template/pages');
    }

    public static function getTemplateName(string $templateNeeded): string
    {
        return AdmService::getTemplateName('template/pages', 'page', $templateNeeded);
    }

    public function getOneBySlug(string $slug): object|null
    {
        $page = Page::query()->where('slug', $slug)->active()->first();

        if($page) {
            $page->increment('views');
            $page->save();
        }

        return $page;
    }
}
