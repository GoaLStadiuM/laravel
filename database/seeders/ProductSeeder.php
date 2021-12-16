<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Random Character Level 1 Division 1',
                'description' => 'You will obtain one character from Division 1 with level 1',
                'level' => 1,
                'division' => 1,
                'price' => 4000,
                'video_url' => '',
                'img_url' => 'img/numbers/1.png'
            ],
            [
                'name' => 'Random Character Level 1 Division 2',
                'description' => 'You will obtain one character from Division 2 with level 1',
                'level' => 1,
                'division' => 2,
                'price' => 1300,
                'video_url' => '',
                'img_url' => 'img/numbers/1.png'
            ],
            [
                'name' => 'Random Character Level 1 Division 3',
                'description' => 'You will obtain one character from Division 3 with level 1',
                'level' => 1,
                'division' => 3,
                'price' => 30,
                'video_url' => '',
                'img_url' => 'img/numbers/1.png'
            ],
            [
                'name' => 'Random Character Level 2 Division 1',
                'description' => 'You will obtain one character from Division 1 with level 2',
                'level' => 2,
                'division' => 1,
                'price' => 5000,
                'video_url' => '',
                'img_url' => 'img/numbers/2.png'
            ],
            [
                'name' => 'Random Character Level 2 Division 2',
                'description' => 'You will obtain one character from Division 2 with level 2',
                'level' => 2,
                'division' => 2,
                'price' => 1400,
                'video_url' => '',
                'img_url' => 'img/numbers/2.png'
            ],
            [
                'name' => 'Random Character Level 2 Division 3',
                'description' => 'You will obtain one character from Division 3 with level 2',
                'level' => 2,
                'division' => 3,
                'price' => 60,
                'video_url' => '',
                'img_url' => 'img/numbers/2.png'
            ],
            [
                'name' => 'Random Character Level 3 Division 1',
                'description' => 'You will obtain one character from Division 1 with level 3',
                'level' => 3,
                'division' => 1,
                'price' => 7000,
                'video_url' => '',
                'img_url' => 'img/numbers/3.png'
            ],
            [
                'name' => 'Random Character Level 3 Division 2',
                'description' => 'You will obtain one character from Division 2 with level 3',
                'level' => 3,
                'division' => 2,
                'price' => 1500,
                'video_url' => '',
                'img_url' => 'img/numbers/3.png'
            ],
            [
                'name' => 'Random Character Level 3 Division 3',
                'description' => 'You will obtain one character from Division 3 with level 3',
                'level' => 3,
                'division' => 3,
                'price' => 120,
                'video_url' => '',
                'img_url' => 'img/numbers/3.png'
            ],
            [
                'name' => 'Random Character Level 4 Division 1',
                'description' => 'You will obtain one character from Division 1 with level 4',
                'level' => 4,
                'division' => 1,
                'price' => 9000,
                'video_url' => '',
                'img_url' => 'img/numbers/4.png'
            ],
            [
                'name' => 'Random Character Level 4 Division 2',
                'description' => 'You will obtain one character from Division 2 with level 4',
                'level' => 4,
                'division' => 2,
                'price' => 1700,
                'video_url' => '',
                'img_url' => 'img/numbers/4.png'
            ],
            [
                'name' => 'Random Character Level 4 Division 3',
                'description' => 'You will obtain one character from Division 3 with level 4',
                'level' => 4,
                'division' => 3,
                'price' => 150,
                'video_url' => '',
                'img_url' => 'img/numbers/4.png'
            ],
            [
                'name' => 'Random Character Level 5 Division 1',
                'description' => 'You will obtain one character from Division 1 with level 5',
                'level' => 5,
                'division' => 1,
                'price' => 12000,
                'video_url' => '',
                'img_url' => 'img/numbers/5.png'
            ],
            [
                'name' => 'Random Character Level 5 Division 2',
                'description' => 'You will obtain one character from Division 2 with level 5',
                'level' => 5,
                'division' => 2,
                'price' => 1900,
                'video_url' => '',
                'img_url' => 'img/numbers/5.png'
            ],
            [
                'name' => 'Random Character Level 5 Division 3',
                'description' => 'You will obtain one character from Division 3 with level 5',
                'level' => 5,
                'division' => 3,
                'price' => 300,
                'video_url' => '',
                'img_url' => 'img/numbers/5.png'
            ],
            [
                'name' => 'Random Character Level 6 Division 2',
                'description' => 'You will obtain one character from Division 2 with level 6',
                'level' => 6,
                'division' => 2,
                'price' => 2100,
                'video_url' => '',
                'img_url' => 'img/numbers/6.png'
            ],
            [
                'name' => 'Random Character Level 6 Division 3',
                'description' => 'You will obtain one character from Division 3 with level 6',
                'level' => 6,
                'division' => 3,
                'price' => 450,
                'video_url' => '',
                'img_url' => 'img/numbers/6.png'
            ],
            [
                'name' => 'Random Character Level 7 Division 2',
                'description' => 'You will obtain one character from Division 2 with level 7',
                'level' => 7,
                'division' => 2,
                'price' => 2500,
                'video_url' => '',
                'img_url' => 'img/numbers/7.png'
            ],
            [
                'name' => 'Random Character Level 7 Division 3',
                'description' => 'You will obtain one character from Division 3 with level 7',
                'level' => 7,
                'division' => 3,
                'price' => 600,
                'video_url' => '',
                'img_url' => 'img/numbers/7.png'
            ],
            [
                'name' => 'Random Character Level 8 Division 2',
                'description' => 'You will obtain one character from Division 2 with level 8',
                'level' => 8,
                'division' => 2,
                'price' => 3000,
                'video_url' => '',
                'img_url' => 'img/numbers/8.png'
            ],
            [
                'name' => 'Random Character Level 8 Division 3',
                'description' => 'You will obtain one character from Division 3 with level 8',
                'level' => 8,
                'division' => 3,
                'price' => 750,
                'video_url' => '',
                'img_url' => 'img/numbers/8.png'
            ],
            [
                'name' => 'Random Character Level 9 Division 3',
                'description' => 'You will obtain one character from Division 3 with level 9',
                'level' => 9,
                'division' => 3,
                'price' => 900,
                'video_url' => '',
                'img_url' => 'img/numbers/9.png'
            ],
            [
                'name' => 'Random Character Level 10 Division 3',
                'description' => 'You will obtain one character from Division 3 with level 10',
                'level' => 10,
                'division' => 3,
                'price' => 1200,
                'video_url' => '',
                'img_url' => 'img/numbers/10.png'
            ]
        ]);
    }
}
