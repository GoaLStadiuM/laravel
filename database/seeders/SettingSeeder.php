<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'code' => 'main_video',
                'value' => 'video/homeheader.mp4'
            ],
            [
                'code' => 'facebook_url',
                'value' => 'https://www.facebook.com/GoaLStadiuM.Official'
            ],
            [
                'code' => 'instagram_url',
                'value' => 'https://www.instagram.com/goal_stadium/'
            ],
            [
                'code' => 'twitter_url',
                'value' => '#'
            ],
            [
                'code' => 'discord_url',
                'value' => 'https://discord.io/GoaLStadiuMOFFICIAL'
            ],
            [
                'code' => 'youtube_url',
                'value' => 'https://www.youtube.com/channel/UCaKAIY6losEN3nZ7q481A1w'
            ],
            [
                'code' => 'telegram_url',
                'value' => 'https://t.me/joinchat/hDIWn72-kcg4MWVk'
            ]
        ]);
    }
}
