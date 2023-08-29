<?php

namespace App\Adm\Services;

use App\Models\Tag;

class TagService
{
    public function getOneBySlug($slug)
    {
        return Tag::query()->where('slug', $slug)->first();
    }

    public static function getAll()
    {
        return Tag::query()
            ->withCount('posts')
            ->get();
    }
}
