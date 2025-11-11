<?php

declare(strict_types=1);

namespace App\Enums;

enum Roles: string
{
    case CUSTOMER = 'customer';
    case AGENT = 'agent';
    case ADMIN = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::CUSTOMER => 'Customer',
            self::AGENT => 'Agent',
            self::ADMIN => 'Admin',
        };
    }
}
