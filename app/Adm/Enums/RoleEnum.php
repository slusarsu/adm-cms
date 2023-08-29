<?php

namespace App\Adm\Enums;

enum RoleEnum: string
{
    case USER = 'user';
    case ADMIN = 'admin';
    case WRITER = 'writer';
    case MODERATOR = 'moderator';

    /**
     * @return array
     */
    public static function allValues(): array
    {
        return [
            self::USER->value,
            self::ADMIN->value,
            self::WRITER->value,
            self::MODERATOR->value,
        ];
    }

    /**
     * @return array
     */
    public static function dashboardAllowedRoles(): array
    {
        return [
            self::ADMIN->value,
            self::WRITER->value,
            self::MODERATOR->value,
        ];
    }

    /**
     * @return array
     */
    public static function usersPermissions(): array
    {
        return [
            self::ADMIN->value,
            self::MODERATOR->value,
        ];
    }
}
