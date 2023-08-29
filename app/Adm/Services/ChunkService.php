<?php

namespace App\Adm\Services;

use App\Models\Chunk;

class ChunkService
{
    public static function getOneBySlug($slug)
    {
        return Chunk::query()->where('slug', $slug)->active()->first();
    }

    public static function getAll()
    {
        return Chunk::query()
            ->active()
            ->orderBy('order')
            ->get();
    }

    public static function getAllByPosition(string $position)
    {
        return Chunk::query()
            ->active()
            ->where('position', $position)
            ->orderBy('order')
            ->get();
    }
}
