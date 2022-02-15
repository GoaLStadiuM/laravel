<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Collaborator;
use App\Models\Influencer;
use App\Models\Member;
use App\Models\Partner;
use App\Models\Setting;
use App\Models\User;

class WebController extends Controller
{
    public function home()
    {
        return view('www.home.home', [
            ...$this->layoutStuff(),
            'yt_video' => Setting::where('code', 'yt_video')->first()->value,
            'partners' => $this->getPartners()
        ]);
    }

    public function team()
    {
        return view('www.team.team', [
            ...$this->layoutStuff(),
            'members' => Member::join('person', 'person.id', '=', 'member.person_id')
                               ->where('person.hidden', false)
                               ->select(
                                   'person.image_url',
                                   'person.name',
                                   'member.title'
                               )
                               ->get(),
            'partners' => $this->getPartners()
        ]);
    }

    public function collaborators()
    {
        return view('www.collaborators.collaborators', [
            ...$this->layoutStuff(),
            'collaborators' => Collaborator::join('person', 'person.id', '=', 'collaborator.person_id')
                                ->join('person_type', 'person_type.id', '=', 'person.type_id')
                                ->where('person.hidden', false)
                                ->select(
                                   'person.image_url',
                                   'person.name',
                                   'person_type.name as title',
                                   'collaborator.country_code'
                                )
                                ->get(),
            'influencers' => Influencer::join('person', 'person.id', '=', 'influencer.person_id')
                                ->join('person_type', 'person_type.id', '=', 'person.type_id')
                                ->where('person.hidden', false)
                                ->select(
                                    'person.image_url',
                                    'person.name',
                                    'person_type.name as title',
                                    'influencer.country_code'
                                )
                                ->get()
                                ->groupBy('title'),
            'partners' => $this->getPartners()
        ]);
    }

    public function rankings()
    {
        return view('www.rankings.rankings', [
            ...$this->layoutStuff(),
            'rewards_users' => User::limit(10)->get(),
            'rewards_characters' => Character::limit(50)->get(),
            'score_user' => User::limit(10)->get(),
            'score_character' => Character::limit(50)->get(),
            'injuries_user' => User::limit(10)->get(),
            'injuries_character' => Character::limit(50)->get()
        ]);
    }

    public function legal()
    {
        return view('stake.stake', [
            ...$this->layoutStuff()
        ]);
    }

    public function privacy()
    {
        return view('stake.stake', [
            ...$this->layoutStuff()
        ]);
    }

    public function cookies()
    {
        return view('stake.stake', [
            ...$this->layoutStuff()
        ]);
    }

    private function getPartners(): array
    {
        return Partner::join('person', 'person.id', '=', 'partner.person_id')
                    ->where('person.hidden', false)
                    ->select('person.name', 'person.image_url', 'partner.website_url')
                    ->get();
    }

    private function layoutStuff(): array
    {
        return Setting::whereIn('code', [
            'contract_address_url',
            'facebook_url',
            'instagram_url',
            'twitter_url',
            'discord_url',
            'youtube_url',
            'telegram_url'
        ])->get()->pluck('value', 'code');
    }
}
