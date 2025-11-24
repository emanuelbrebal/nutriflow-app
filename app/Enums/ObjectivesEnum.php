<?php

namespace App\Enums;

enum ObjectivesEnum: int
{
    case WeightLoss = 1;
    case WeightMaintains = 2;
    case MuscleGains = 3;
    case NutritionalReeducate = 4;

    public function getLabel(): string
    {
        return match ($this) {
            self::WeightLoss => 'Perder peso',
            self::WeightMaintains => 'Manter peso',
            self::MuscleGains => 'Ganhar massa muscular',
            self::NutritionalReeducate => 'Reeducação alimentar',
        };
    }

    public static function options(): array
    {
        return array_map(fn($case) => [
            'value' => $case->value,
            'label' => $case->getLabel(),
        ], self::cases());
    }
}