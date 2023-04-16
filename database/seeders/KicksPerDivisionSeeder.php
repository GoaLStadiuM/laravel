<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KicksPerDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('kicks_per_division')->upsert([
            [
                'kicks' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'kicks' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'kicks' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ], [ 'kicks' ], [ 'kicks', 'updated_at' ]);
    }
}
