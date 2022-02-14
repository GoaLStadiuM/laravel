<section class="team-member-area pb-125">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="section-title title-style-three text-center mb-70">
                    <h2>YOU<span>TUBERS</span></h2>
                </div>
            </div>
        </div>
        <div class="row" style="justify-content: center;">
            @foreach($influencers['youtuber'] as $youtuber)
                @component('www.collaborators.components.member')
                    @slot('img') {{ asset("$youtuber->image_url.webp") }} @endslot
                    @slot('name') {{ $youtuber->name }} @endslot
                    @slot('title') {{ $youtuber->title }} @endslot
                    @slot('flag') {{ $youtuber->country_code }} @endslot
                @endcomponent
            @endforeach
        </div>
    </div>
</section>
