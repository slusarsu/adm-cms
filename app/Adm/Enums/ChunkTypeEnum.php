<?php

namespace App\Adm\Enums;

enum ChunkTypeEnum: string
{
    case TEXT = 'text';
    case HTML = 'html';

    public static function allValues(): array
    {
        return [
            self::TEXT->value => self::TEXT->value,
            self::HTML->value => self::HTML->value,
        ];
    }
}
