<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class XpForLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('xp_for_level')->insert([
            [
                'division' => 1,
                'level' => 1,
                'xp_for_next_level' => 360
            ],
            [
                'division' => 2,
                'level' => 1,
                'xp_for_next_level' => 150
            ],
            [
                'division' => 3,
                'level' => 1,
                'xp_for_next_level' => 60
            ],
            [
                'division' => 1,
                'level' => 2,
                'xp_for_next_level' => 389
            ],
            [
                'division' => 2,
                'level' => 2,
                'xp_for_next_level' => 158
            ],
            [
                'division' => 3,
                'level' => 2,
                'xp_for_next_level' => 62
            ],
            [
                'division' => 1,
                'level' => 3,
                'xp_for_next_level' => 420
            ],
            [
                'division' => 2,
                'level' => 3,
                'xp_for_next_level' => 165
            ],
            [
                'division' => 3,
                'level' => 3,
                'xp_for_next_level' => 65
            ],
            [
                'division' => 1,
                'level' => 4,
                'xp_for_next_level' => 441
            ],
            [
                'division' => 2,
                'level' => 4,
                'xp_for_next_level' => 174
            ],
            [
                'division' => 3,
                'level' => 4,
                'xp_for_next_level' => 67
            ],
            [
                'division' => 1,
                'level' => 5,
                'xp_for_next_level' => 0
            ],
            [
                'division' => 2,
                'level' => 5,
                'xp_for_next_level' => 182
            ],
            [
                'division' => 3,
                'level' => 5,
                'xp_for_next_level' => 70
            ],
            [
                'division' => 2,
                'level' => 6,
                'xp_for_next_level' => 191
            ],
            [
                'division' => 3,
                'level' => 6,
                'xp_for_next_level' => 73
            ],
            [
                'division' => 2,
                'level' => 7,
                'xp_for_next_level' => 201
            ],
            [
                'division' => 3,
                'level' => 7,
                'xp_for_next_level' => 76
            ],
            [
                'division' => 2,
                'level' => 8,
                'xp_for_next_level' => 0
            ],
            [
                'division' => 3,
                'level' => 8,
                'xp_for_next_level' => 79
            ],
            [
                'division' => 3,
                'level' => 9,
                'xp_for_next_level' => 82
            ],
            [
                'division' => 3,
                'level' => 10,
                'xp_for_next_level' => 0
            ]
        ]);
    }
}
