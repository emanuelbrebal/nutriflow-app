<?php

namespace App\Enums;

enum AccountTypeEnum: int
{
    case Student = 1;
    case Nutritionist = 2;
    case Patient = 3;
    case Admin = 4;

    public function getLabel(): string
    {
        return match ($this) {
            self::Student => 'Student',
            self::Nutritionist => 'Nutritionist',
            self::Patient => 'Patient',
            self::Admin => 'Administrator',
        };
    }
}
