<?php

namespace App\Enums;

enum StatusEnum: int
{
    case Incomplete = 1;
    case Active = 2;
    case Inactive = 3;

    public function getLabel(): string
    {
        return match ($this) {
            self::Incomplete => 'Incomplete',
            self::Active => 'Active',
            self::Inactive => 'Inactive',
        };
    }
}
