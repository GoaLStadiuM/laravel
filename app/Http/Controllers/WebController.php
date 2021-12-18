<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class WebController extends Controller
{
    public function landing()
    {
        return view('landing.landing', $this->footer_urls());
    }

    public function partner()
    {
        return view('partner.partner', $this->footer_urls());
    }

    public function stake()
    {
        return view('stake.stake', $this->footer_urls());
    }

    public function team()
    {
        return view('team.team', $this->footer_urls());
    }

    public function audits()
    {
        return view('audits.audits', $this->footer_urls());
    }

    private function footer_urls(): array
    {
        return [
            'facebook_url'  => Setting::where('code', 'facebook_url')->first()->value,
            'instagram_url' => Setting::where('code', 'instagram_url')->first()->value,
            'twitter_url'   => Setting::where('code', 'twitter_url')->first()->value,
            'discord_url'   => Setting::where('code', 'discord_url')->first()->value,
            'youtube_url'   => Setting::where('code', 'youtube_url')->first()->value,
            'telegram_url'  => Setting::where('code', 'telegram_url')->first()->value
        ];
    }
}
