<?php

trait GoalToken
{
    private string $apiUrl = 'https://api.pancakeswap.info/api/v2/tokens/0xbf4013ca1d3d34873a3f02b5d169e593185b0204';

    protected function getPriceInGoal(int $price): string
    {
        return bcdiv($price, $this->getJsonObject($this->apiUrl)->data->price);
    }

    private function getJsonObject(string $url): stdClass
    {
        return json_decode(file_get_contents($url));
    }
}
