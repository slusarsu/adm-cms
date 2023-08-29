<?php

namespace App\Adm\Services;

use App\Models\Gallery;

class GalleryService
{
    public static function getOneBySlug($slug)
    {
        return Gallery::query()->where('slug', $slug)->first();
    }

    public static function getAll()
    {
        return Gallery::query()->get();
    }
}
