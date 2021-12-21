<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StakingOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staking_option')->insert([
            [
                'vesting_period' => 'P7D',
                'bonus_percentage' => 3
            ],
            [
                'vesting_period' => 'P15D',
                'bonus_percentage' => 8
            ],
            [
                'vesting_period' => 'P1M',
                'bonus_percentage' => 20
            ],
            [
                'vesting_period' => 'P3M',
                'bonus_percentage' => 65
            ],
            [
                'vesting_period' => 'P6M',
                'bonus_percentage' => 140
            ],
            [
                'vesting_period' => 'P1Y',
                'bonus_percentage' => 300
            ]
        ]);
    }
}
