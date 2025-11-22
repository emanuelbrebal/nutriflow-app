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
            self::Student => 'Aluno(a)',      
            self::Nutritionist => 'Nutricionista',
            self::Patient => 'Paciente',
            self::Admin => 'Administrador',
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
