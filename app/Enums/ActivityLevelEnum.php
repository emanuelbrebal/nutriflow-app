<?php

namespace App\Enums;

enum AccountTypeEnum: int
{
    case Sedentary = 1;
    case Light = 2;
    case Moderate = 3;
    case High = 4;
    case VeryHigh = 5;
    
    public function getLabel(): string
    {
        return match($this) {
            self::Sedentary => 'Sedentário (pouca ou nenhuma atividade)',
            self::Light => 'Leve (1 a 3 dias na semana)',
            self::Moderate => 'Moderado (3 a 5 dias na semana)',
            self::High => 'Ativo (3 a 5 dias de exercícios na semana mais cardio)',
            self::VeryHigh => 'Muito ativo (6 a 7 dias de exercícios na semana mais cardio)',
        };
    }
}