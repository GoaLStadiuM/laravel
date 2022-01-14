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
        $now = new DateTime(null, new DateTimeZone('UTC'));

        DB::table('staking_option')->insert([
            [
                'vesting_period' => 'P7D',
                'bonus_percentage' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'vesting_period' => 'P15D',
                'bonus_percentage' => 8,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'vesting_period' => 'P1M',
                'bonus_percentage' => 20,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'vesting_period' => 'P3M',
                'bonus_percentage' => 65,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'vesting_period' => 'P6M',
                'bonus_percentage' => 140,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'vesting_period' => 'P1Y',
                'bonus_percentage' => 300,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
