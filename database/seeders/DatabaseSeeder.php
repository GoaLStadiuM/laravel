<?php

namespace Database\Seeders;

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
            BaseCharacterSeeder::class,
            KicksPerDivisionSeeder::class,
            ProductSeeder::class,
            SettingSeeder::class,
            StakingOptionSeeder::class,
            //StatusSeeder::class,
            TrainingSessionSeeder::class,
            XpForLevelSeeder::class
        ]);
    }
}
