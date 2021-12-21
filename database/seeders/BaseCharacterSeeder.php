<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaseCharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('base_character')->insert([
            [
                'name' => 'Amiguita',
                'probability' => 20,
                'video_url' => '',
                'img_url' => 'img/character/1'
            ],
            [
                'name' => 'Benja',
                'probability' => 10,
                'video_url' => 'video/benja',
                'img_url' => 'img/character/2'
            ],
            [
                'name' => 'Crisnaldo',
                'probability' => 10,
                'video_url' => 'video/crisnaldo',
                'img_url' => 'img/character/3'
            ],
            [
                'name' => 'Elmaffe',
                'probability' => 10,
                'video_url' => '',
                'img_url' => 'img/character/4'
            ],
            [
                'name' => 'Fatnaldo',
                'probability' => 5,
                'video_url' => '',
                'img_url' => 'img/character/5'
            ],
            [
                'name' => 'Filip Kahan',
                'probability' => 35,
                'video_url' => '',
                'img_url' => 'img/character/6'
            ],
            [
                'name' => 'Hypsola',
                'probability' => 35,
                'video_url' => 'video/hypsola',
                'img_url' => 'img/character/7'
            ],
            [
                'name' => 'Johan',
                'probability' => 5,
                'video_url' => '',
                'img_url' => 'img/character/8'
            ],
            [
                'name' => 'Juana',
                'probability' => 35,
                'video_url' => '',
                'img_url' => 'img/character/9'
            ],
            [
                'name' => 'July Tos',
                'probability' => 35,
                'video_url' => '',
                'img_url' => 'img/character/10'
            ],
            [
                'name' => 'Kassimessy',
                'probability' => 3,
                'video_url' => '',
                'img_url' => 'img/character/11'
            ],
            [
                'name' => 'Luzjasper',
                'probability' => 35,
                'video_url' => '',
                'img_url' => 'img/character/12'
            ],
            [
                'name' => 'Mack Level',
                'probability' => 5,
                'video_url' => '',
                'img_url' => 'img/character/13'
            ],
            [
                'name' => 'Marta',
                'probability' => 30,
                'video_url' => '',
                'img_url' => 'img/character/14'
            ],
            [
                'name' => 'Opiver Haston',
                'probability' => 5,
                'video_url' => '',
                'img_url' => 'img/character/15'
            ],
            [
                'name' => 'Padel Morgan',
                'probability' => 35,
                'video_url' => '',
                'img_url' => 'img/character/16'
            ],
            [
                'name' => 'Panycesta',
                'probability' => 5,
                'video_url' => '',
                'img_url' => 'img/character/17'
            ],
            [
                'name' => 'Peque',
                'probability' => 20,
                'video_url' => 'video/peque',
                'img_url' => 'img/character/18'
            ],
            [
                'name' => 'Peludona',
                'probability' => 10,
                'video_url' => '',
                'img_url' => 'img/character/19'
            ],
            [
                'name' => 'Red Warrer',
                'probability' => 35,
                'video_url' => 'video/warrer',
                'img_url' => 'img/character/20'
            ],
            [
                'name' => 'Reymar RJ',
                'probability' => 3,
                'video_url' => '',
                'img_url' => 'img/character/21'
            ],
            [
                'name' => 'Zincaldinho',
                'probability' => 20,
                'video_url' => '',
                'img_url' => 'img/character/22'
            ],
            [
                'name' => 'Mohate Salao',
                'probability' => 10,
                'video_url' => '',
                'img_url' => 'img/character/23'
            ],
            [
                'name' => 'Sinedine Sidine',
                'probability' => 5,
                'video_url' => 'video/sinedine',
                'img_url' => 'img/character/24'
            ],
            [
                'name' => 'Tonti',
                'probability' => 10,
                'video_url' => '',
                'img_url' => 'img/character/25'
            ],
            [
                'name' => 'Trensis',
                'probability' => 25,
                'video_url' => '',
                'img_url' => 'img/character/26'
            ]
        ]);
    }
}
