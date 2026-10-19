<?php

namespace App\Enums;

enum Role: string
{
    case Visitor = 'vizitator';
    case Operator = 'operator';
    case Administrator = 'administrator';

    public function label(): string
    {
        return match ($this) {
            self::Visitor => 'Vizitator',
            self::Operator => 'Operator',
            self::Administrator => 'Administrator',
        };
    }

    public function canManageCarParts(): bool
    {
        return $this === self::Administrator;
    }

    public function canViewAdministration(): bool
    {
        return $this === self::Administrator || $this === self::Operator;
    }

    public function canSubmitContact(): bool
    {
        return $this === self::Visitor || $this === self::Administrator;
    }
}
