<?php

namespace App\Enums;

enum BiologicalSexEnum: int
{
    case Male = 1;
    case Female = 2;

    public function getLabel(): string
    {
        return match ($this) {
            self::Male => 'Masculino',
            self::Female => 'Feminino',
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
