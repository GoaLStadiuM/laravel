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
        DB::table('training_session')->insert([
            [
                'name' => 'Head Training',
                'max_hours' => 6
            ],
            [
                'name' => 'Shoulders Training',
                'max_hours' => 6
            ],
            [
                'name' => 'Knees Training',
                'max_hours' => 6
            ],
            [
                'name' => 'Feet Training',
                'max_hours' => 6
            ],
        ]);
    }
}
