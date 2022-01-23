<?php declare(strict_types=1);

namespace App\Models;

class Division
{
    public const FIRST_DIVISION = 1,
                 SECOND_DIVISION = 2,
                 THIRD_DIVISION = 3;

    public function __construct(public int $division) {}

    public function getMaxPercentage(): int
    {
        return match ($this->division) {
             self::FIRST_DIVISION => 90,
            self::SECOND_DIVISION => 80,
             self::THIRD_DIVISION => 70
        };
    }

    public function getMaxStats(): int
    {
        return match ($this->division) {
             self::FIRST_DIVISION => 171,
            self::SECOND_DIVISION => 152,
             self::THIRD_DIVISION => 133
        };
    }

    public function getStartingPercentage(): int
    {
        return match ($this->division) {
             self::FIRST_DIVISION => 50,
            self::SECOND_DIVISION => 40,
             self::THIRD_DIVISION => 30
        };
    }

    public function getStartingStats(): int
    {
        return match ($this->division) {
             self::FIRST_DIVISION => 95,
            self::SECOND_DIVISION => 76,
             self::THIRD_DIVISION => 57
        };
    }
}
