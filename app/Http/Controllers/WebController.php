<?php

namespace App\Http\Controllers;

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
        return Setting::whereIn('code', [
            'facebook_url',
            'instagram_url',
            'twitter_url',
            'discord_url',
            'youtube_url',
            'telegram_url'
        ])->get()->pluck('value', 'code');
    }
}
