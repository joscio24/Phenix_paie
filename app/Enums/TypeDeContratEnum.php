<?php

namespace App;

namespace App\Enums;
enum TypeDeContratEnum : string
{
    //
    case CDI = 'CDI';  // Permanent contract
    case CDD = 'CDD';  // Fixed-term contract
    case Freelance = 'Freelance';  // Freelance contract
    case Stage = 'Stage';

    // Method to get all enum values
    public static function getValues(): array
    {
        return array_map(fn($enum) => $enum->value, self::cases());
    }
}
