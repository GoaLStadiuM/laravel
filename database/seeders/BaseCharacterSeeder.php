<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BaseCharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('base_character')->upsert([
            [
                'name' => 'Amiguita',
                'probability' => 20,
                'video_url' => '',
                'img_url' => 'img/character/1',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Benja',
                'probability' => 10,
                'video_url' => 'video/benja',
                'img_url' => 'img/character/2',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Crisnaldo',
                'probability' => 10,
                'video_url' => 'video/crisnaldo',
                'img_url' => 'img/character/3',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Elmaffe',
                'probability' => 10,
                'video_url' => '',
                'img_url' => 'img/character/4',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Fatnaldo',
                'probability' => 5,
                'video_url' => '',
                'img_url' => 'img/character/5',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Filip Kahan',
                'probability' => 35,
                'video_url' => '',
                'img_url' => 'img/character/6',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Hypsola',
                'probability' => 35,
                'video_url' => 'video/hypsola',
                'img_url' => 'img/character/7',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Johan',
                'probability' => 5,
                'video_url' => '',
                'img_url' => 'img/character/8',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Juana',
                'probability' => 35,
                'video_url' => '',
                'img_url' => 'img/character/9',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'July Tos',
                'probability' => 35,
                'video_url' => '',
                'img_url' => 'img/character/10',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Kassimessy',
                'probability' => 3,
                'video_url' => '',
                'img_url' => 'img/character/11',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Luzjasper',
                'probability' => 35,
                'video_url' => '',
                'img_url' => 'img/character/12',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Mack Level',
                'probability' => 5,
                'video_url' => '',
                'img_url' => 'img/character/13',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Marta',
                'probability' => 30,
                'video_url' => '',
                'img_url' => 'img/character/14',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Opiver Haston',
                'probability' => 5,
                'video_url' => '',
                'img_url' => 'img/character/15',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Padel Morgan',
                'probability' => 35,
                'video_url' => '',
                'img_url' => 'img/character/16',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Panycesta',
                'probability' => 5,
                'video_url' => '',
                'img_url' => 'img/character/17',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Peque',
                'probability' => 20,
                'video_url' => 'video/peque',
                'img_url' => 'img/character/18',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Peludona',
                'probability' => 10,
                'video_url' => '',
                'img_url' => 'img/character/19',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Red Warrer',
                'probability' => 35,
                'video_url' => 'video/warrer',
                'img_url' => 'img/character/20',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Reymar RJ',
                'probability' => 3,
                'video_url' => '',
                'img_url' => 'img/character/21',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Zincaldinho',
                'probability' => 20,
                'video_url' => '',
                'img_url' => 'img/character/22',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Mohate Salao',
                'probability' => 10,
                'video_url' => '',
                'img_url' => 'img/character/23',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Sinedine Sidine',
                'probability' => 5,
                'video_url' => 'video/sinedine',
                'img_url' => 'img/character/24',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Tonti',
                'probability' => 10,
                'video_url' => '',
                'img_url' => 'img/character/25',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Trensis',
                'probability' => 25,
                'video_url' => '',
                'img_url' => 'img/character/26',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ], [ 'name' ], [ 'name', 'probability', 'video_url', 'img_url', 'updated_at' ]);
    }
}
