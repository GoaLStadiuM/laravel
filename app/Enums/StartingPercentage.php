<?php declare(strict_types=1);

namespace App\Enums;

enum StartingPercentage: int
{
    case FIRST_DIVISION = 50;
    case SECOND_DIVISION = 40;
    case THIRD_DIVISION = 30;
}
