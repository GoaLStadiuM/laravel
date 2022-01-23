<?php declare(strict_types=1);

namespace App\Traits;

use stdClass;

trait GoalToken
{
    public static int $DECIMALS = 7;
    protected int $GOAL_PRICE_IN_GLS = 10;
    private string $apiUrl = 'https://api.pancakeswap.info/api/v2/tokens/0xbf4013ca1d3d34873a3f02b5d169e593185b0204';

    protected function goalPrice(): string
    {
        return $this->getJsonObject($this->apiUrl)->data->price;
    }

    protected function getPriceInGoal(int $price): string
    {
        return bcdiv(strval($price), $this->getJsonObject($this->apiUrl)->data->price, self::DECIMALS);
    }

    private function getJsonObject(string $url): stdClass
    {
        return json_decode(file_get_contents($url));
    }
}
