<?php

namespace App\Enums;

enum PlanLevelEnum: int
{
    case Free = 1;
    case Intermediate = 2;
    case Premium = 3;

    public function getLabel(): string
    {
        return match ($this) {
            self::Free => 'Free',
            self::Intermediate => 'Intermediate',
            self::Premium => 'Premium',
        };
    }
}
