<?php

namespace App\Enums;

enum AccountTypeEnum: int
{
    case WeightLoss = 1;
    case WeightMaintains = 2;
    case MuscleGains = 3;
    case NutritionalReeducate = 4;
    
    public function getLabel(): string
    {
        return match($this) {
            self::WeightLoss => 'Perder peso',
            self::WeightMaintains => 'Manter peso',
            self::MuscleGains => 'Ganhar massa muscular',
            self::NutritionalReeducate => 'Reeducação alimentar',
        };
    }
}