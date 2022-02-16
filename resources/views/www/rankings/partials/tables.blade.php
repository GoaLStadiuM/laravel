<section class="my-match-area staking-bg pt-80 pb-120">
    <div class="container custom-container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Top Rewards</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Top Goal Scores</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Top Injuries</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">
                    <div class="col-lg-6">
                        @component('www.rankings.components.table', [ 'rows' => $rewards_users, 'header' => [ 'User', 'Rewards (GLS)' ] ])
                            @slot('color') gold @endslot
                        @endcomponent
                    </div>
                    <div class="col-lg-6">
                        @component('www.rankings.components.table', [ 'rows' => $rewards_characters, 'header' => [ 'Character', 'Rewards (GLS)' ] ])
                            @slot('color') DarkGoldenRod @endslot
                        @endcomponent
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="row">
                    <div class="col-lg-6">
                        @component('www.rankings.components.table', [ 'rows' => $score_users, 'header' => [ 'User', 'Goal Score' ] ])
                            @slot('color') gold @endslot
                        @endcomponent
                    </div>
                    <div class="col-lg-6">
                        @component('www.rankings.components.table', [ 'rows' => $score_characters, 'header' => [ 'Character', 'Goal Score' ] ])
                            @slot('color') DarkGoldenRod @endslot
                        @endcomponent
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="row">
                    <div class="col-lg-6">
                        @component('www.rankings.components.table', [ 'rows' => $injuries_users, 'header' => [ 'User', 'Injuries' ] ])
                            @slot('color') gold @endslot
                        @endcomponent
                    </div>
                    <div class="col-lg-6">
                        @component('www.rankings.components.table', [ 'rows' => $injuries_characters, 'header' => [ 'Character', 'Injuries' ] ])
                            @slot('color') DarkGoldenRod @endslot
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
