<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KicksPerDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new DateTime(null, new DateTimeZone('UTC'));

        DB::table('kicks_per_division')->insert([
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
        ]);
    }
}
