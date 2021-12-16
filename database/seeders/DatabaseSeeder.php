<?php

namespace Database\Seeders;

use App\Models\Presalecode;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            //SettingSeeder::class,
            //StatusSeeder::class,
            //ProductSeeder::class,
            //CharacterSeeder::class
        ]);
    }
}
