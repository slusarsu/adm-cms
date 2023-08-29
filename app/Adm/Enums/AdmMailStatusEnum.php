<?php

namespace App\Adm\Enums;

enum AdmMailStatusEnum: string
{
    case SENT = 'sent';
    case NOT_SENT = 'not_sent';
    case ERROR_SENT = 'error_sent';

    public static function allValues(): array
    {
        return [
            self::SENT->value => self::SENT->value,
            self::NOT_SENT->value => self::NOT_SENT->value,
            self::ERROR_SENT->value => self::ERROR_SENT->value,
        ];
    }
}
