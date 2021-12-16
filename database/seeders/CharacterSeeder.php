<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('characters')->insert([
            [
                'name' => 'Amiguita',
                'video_url' => '#',
                'img_url' => 'img/character/01.webp'
            ],
            [
                'name' => 'Benja',
                'video_url' => 'video/benja.webm',
                'img_url' => 'img/character/02.webp'
            ],
            [
                'name' => 'Crisnaldo',
                'video_url' => 'video/crisnaldo.webm',
                'img_url' => 'img/character/03.webp'
            ],
            [
                'name' => 'Elmaffe',
                'video_url' => '#',
                'img_url' => 'img/character/04.webp'
            ],
            [
                'name' => 'Fatnaldo',
                'video_url' => '#',
                'img_url' => 'img/character/05.webp'
            ],
            [
                'name' => 'Filip Kahan',
                'video_url' => '#',
                'img_url' => 'img/character/06.webp'
            ],
            [
                'name' => 'Hypsola',
                'video_url' => 'video/hypsola.webm',
                'img_url' => 'img/character/07.webp'
            ],
            [
                'name' => 'Johan',
                'video_url' => '#',
                'img_url' => 'img/character/08.webp'
            ],
            [
                'name' => 'Juana',
                'video_url' => '#',
                'img_url' => 'img/character/09.webp'
            ],
            [
                'name' => 'July Tos',
                'video_url' => '#',
                'img_url' => 'img/character/10.webp'
            ],
            [
                'name' => 'Kassimessy',
                'video_url' => '#',
                'img_url' => 'img/character/11.webp'
            ],
            [
                'name' => 'Luzjasper',
                'video_url' => '#',
                'img_url' => 'img/character/12.webp'
            ],
            [
                'name' => 'Mack Level',
                'video_url' => '#',
                'img_url' => 'img/character/13.webp'
            ],
            [
                'name' => 'Marta',
                'video_url' => '#',
                'img_url' => 'img/character/14.webp'
            ],
            [
                'name' => 'Opiver Haston',
                'video_url' => '#',
                'img_url' => 'img/character/15.webp'
            ],
            [
                'name' => 'Padel Morgan',
                'video_url' => '#',
                'img_url' => 'img/character/16.webp'
            ],
            [
                'name' => 'Panycesta',
                'video_url' => '#',
                'img_url' => 'img/character/17.webp'
            ],
            [
                'name' => 'Peque',
                'video_url' => 'video/peque.webm',
                'img_url' => 'img/character/18.webp'
            ],
            [
                'name' => 'Peludona',
                'video_url' => '#',
                'img_url' => 'img/character/19.webp'
            ],
            [
                'name' => 'Red Warrer',
                'video_url' => 'video/warrer.webm',
                'img_url' => 'img/character/20.webp'
            ],
            [
                'name' => 'Reymar RJ',
                'video_url' => '#',
                'img_url' => 'img/character/21.webp'
            ],
            [
                'name' => 'Zincaldinho',
                'video_url' => '#',
                'img_url' => 'img/character/22.webp'
            ],
            [
                'name' => 'Mohate Salao',
                'video_url' => '#',
                'img_url' => 'img/character/23.webp'
            ],
            [
                'name' => 'Sinedine Sidine',
                'video_url' => 'video/sinedine.webm',
                'img_url' => 'img/character/24.webp'
            ],
            [
                'name' => 'Tonti',
                'video_url' => '#',
                'img_url' => 'img/character/25.webp'
            ],
            [
                'name' => 'Trensis',
                'video_url' => '#',
                'img_url' => 'img/character/26.webp'
            ]
        ]);
    }
}
