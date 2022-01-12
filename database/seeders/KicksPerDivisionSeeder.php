<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KicksPerDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kicks_per_division')->insert([
            [
                'kicks' => 4
            ],
            [
                'kicks' => 2
            ],
            [
                'kicks' => 1
            ]
        ]);
    }
}
