<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new DateTime(null, new DateTimeZone('UTC'));

        DB::table('training_session')->insert([
            [
                'name' => 'Head Training',
                'max_hours' => 6,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Shoulders Training',
                'max_hours' => 6,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Knees Training',
                'max_hours' => 6,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Feet Training',
                'max_hours' => 6,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
