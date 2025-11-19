<?php

namespace App\Enums;

enum CalculusProtocolEnum: int
{
    case Pollock3 = 1;
    case Pollock7 = 2;
    case Guedes = 3;

    public function getLabel(): string
    {
         return match($this) {
            self::Pollock3 => 'Pollock 3 Dobras (Padrão)',
            self::Pollock7 => 'Pollock 7 Dobras (Completo)',
            self::Guedes => 'Guedes (População Brasileira)',
        };
    }
}
