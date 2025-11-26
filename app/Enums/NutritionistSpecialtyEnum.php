<?php

namespace App\Enums;

enum NutritionistSpecialtyEnum: int
{
    case Clinical = 1;
    case Sports = 2;
    case MaternalChild = 3;
    case Functional = 4;
    case Aesthetics = 5;
    case Oncology = 6;
    case Gerontology = 7;
    case PublicHealth = 8;
    case FoodService = 9; 

    public function getLabel(): string
    {
        return match ($this) {
            self::Clinical => 'Nutrição Clínica',
            self::Sports => 'Nutrição Esportiva',
            self::MaternalChild => 'Materno-Infantil',
            self::Functional => 'Nutrição Funcional',
            self::Aesthetics => 'Nutrição Estética',
            self::Oncology => 'Oncologia',
            self::Gerontology => 'Gerontologia',
            self::PublicHealth => 'Saúde Coletiva',
            self::FoodService => 'Alimentação Coletiva (UAN)',
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