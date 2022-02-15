<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Collaborator;
use App\Models\Influencer;
use App\Models\Member;
use App\Models\Partner;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Collection;

class WebController extends Controller
{
    public function home()
    {
        return view('www.home.home', [
            ...$this->layoutStuff(),
            'yt_video' => Setting::where('code', 'yt_video')->firstOrFail()->value,
            'partners' => $this->getPartners()
        ]);
    }

    public function team()
    {
        return view('www.team.team', [
            ...$this->layoutStuff(),
            'members' => Member::join('entity', 'entity.id', '=', 'member.entity_id')
                               ->where('entity.hidden', false)
                               ->select(
                                   'entity.image_url',
                                   'entity.name',
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
            'collaborators' => Collaborator::join('entity', 'entity.id', '=', 'collaborator.entity_id')
                                ->join('entity_type', 'entity_type.id', '=', 'entity.type_id')
                                ->where('entity.hidden', false)
                                ->select(
                                   'entity.image_url',
                                   'entity.name',
                                   'entity_type.name as title',
                                   'collaborator.country_code'
                                )
                                ->get(),
            'influencers' => Influencer::join('entity', 'entity.id', '=', 'influencer.entity_id')
                                ->join('entity_type', 'entity_type.id', '=', 'entity.type_id')
                                ->where('entity.hidden', false)
                                ->select(
                                    'entity.image_url',
                                    'entity.name',
                                    'entity_type.name as title',
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
        return view('www.legal', [
            ...$this->layoutStuff()
        ]);
    }

    public function privacy()
    {
        return view('www.privacy', [
            ...$this->layoutStuff()
        ]);
    }

    public function cookies()
    {
        return view('www.cookies', [
            ...$this->layoutStuff()
        ]);
    }

    public function user()
    {
        return view('www.user.user', [
            ...$this->layoutStuff()
        ]);
    }

    private function getPartners(): Collection
    {
        return Partner::join('entity', 'entity.id', '=', 'partner.entity_id')
                    ->where('entity.hidden', false)
                    ->select('entity.name', 'entity.image_url', 'partner.website_url')
                    ->get();
    }

    private function layoutStuff(): Collection
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
