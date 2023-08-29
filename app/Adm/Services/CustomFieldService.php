<?php

namespace App\Adm\Services;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class CustomFieldService
{
    private static array $customFields;

    /**
     * @param string $typeName
     * @param array $typeFields
     * @return void
     */
    public static function setCustomFields(string $typeName, array $typeFields): void
    {
        self::$customFields[$typeName] = $typeFields;
    }

    public static function customFieldsByPostType(string $postType)
    {
        return static::$customFields[$postType] ?? [];
    }
}
