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
                'name' => 'training_head',
                'max_hours' => 6
            ],
            [
                'name' => 'training_shoulders',
                'max_hours' => 6
            ],
            [
                'name' => 'training_knees',
                'max_hours' => 6
            ],
            [
                'name' => 'training_feet',
                'max_hours' => 6
            ],
        ]);
    }
}
