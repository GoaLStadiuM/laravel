<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class XpForLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('xp_for_level')->upsert([
            [
                'division' => 1,
                'level' => 1,
                'xp_for_next_level' => 360,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 2,
                'level' => 1,
                'xp_for_next_level' => 150,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 3,
                'level' => 1,
                'xp_for_next_level' => 60,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 1,
                'level' => 2,
                'xp_for_next_level' => 389,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 2,
                'level' => 2,
                'xp_for_next_level' => 158,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 3,
                'level' => 2,
                'xp_for_next_level' => 62,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 1,
                'level' => 3,
                'xp_for_next_level' => 420,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 2,
                'level' => 3,
                'xp_for_next_level' => 165,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 3,
                'level' => 3,
                'xp_for_next_level' => 65,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 1,
                'level' => 4,
                'xp_for_next_level' => 441,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 2,
                'level' => 4,
                'xp_for_next_level' => 174,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 3,
                'level' => 4,
                'xp_for_next_level' => 67,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 1,
                'level' => 5,
                'xp_for_next_level' => 0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 2,
                'level' => 5,
                'xp_for_next_level' => 182,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 3,
                'level' => 5,
                'xp_for_next_level' => 70,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 2,
                'level' => 6,
                'xp_for_next_level' => 191,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 3,
                'level' => 6,
                'xp_for_next_level' => 73,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 2,
                'level' => 7,
                'xp_for_next_level' => 201,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 3,
                'level' => 7,
                'xp_for_next_level' => 76,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 2,
                'level' => 8,
                'xp_for_next_level' => 0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 3,
                'level' => 8,
                'xp_for_next_level' => 79,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 3,
                'level' => 9,
                'xp_for_next_level' => 82,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'division' => 3,
                'level' => 10,
                'xp_for_next_level' => 0,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ], [ 'division', 'level' ], [ 'division', 'level', 'xp_for_next_level', 'updated_at' ]);
    }
}
