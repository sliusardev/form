<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case CLIENT = 'client';

    /**
     * Get all available roles as an array.
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get a readable name for the role.
     */
    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrator',
            self::CLIENT => 'Client',
        };
    }
}
