<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('setting')->upsert([
            [
                'code' => 'facebook_url',
                'value' => 'https://www.facebook.com/GoaLStadiuM.Official',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'code' => 'instagram_url',
                'value' => 'https://www.instagram.com/goal_stadium/',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'code' => 'twitter_url',
                'value' => '#',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'code' => 'discord_url',
                'value' => 'https://discord.io/GoaLStadiuMOFFICIAL',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'code' => 'youtube_url',
                'value' => 'https://www.youtube.com/channel/UCaKAIY6losEN3nZ7q481A1w',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'code' => 'telegram_url',
                'value' => 'https://t.me/joinchat/hDIWn72-kcg4MWVk',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'code' => 'contract_address_url',
                'value' => 'https://bscscan.com/token/0xBF4013ca1d3D34873A3f02B5D169E593185B0204',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'code' => 'yt_video',
                'value' => 'https://www.youtube.com/embed/I9n7oQNj400',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ], [ 'code' ], [ 'code', 'value', 'updated_at' ]);
    }
}
