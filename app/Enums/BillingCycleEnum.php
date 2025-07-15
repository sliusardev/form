<?php

namespace App\Enums;

enum BillingCycleEnum: string
{
    case MONTHLY = 'monthly';
    case YEARLY = 'yearly';

    public function label(): string
    {
        return match($this) {
            self::MONTHLY => 'Monthly',
            self::YEARLY => 'Yearly',
        };
    }

    public function getDays(): int
    {
        return match($this) {
            self::MONTHLY => now()->daysInMonth,
            self::YEARLY => now()->daysInYear,
        };
    }

    public static function options(): array
    {
        return [
            self::MONTHLY->value => self::MONTHLY->label(),
            self::YEARLY->value => self::YEARLY->label(),
        ];
    }
}
