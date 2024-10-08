<section class="team-member-area pb-125">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="section-title title-style-three text-center mb-70">
                    <h2>Tik<span>Tokers</span></h2>
                </div>
            </div>
        </div>
        <div class="row" style="justify-content: center;">
            @foreach($influencers['TikToker'] as $tiktoker)
                @component('www.collaborators.components.member')
                    @slot('img_url') {{ $tiktoker->image_url }} @endslot
                    @slot('name') {{ $tiktoker->name }} @endslot
                    @slot('title') {{ $tiktoker->title }} @endslot
                    @slot('flag') {{ $tiktoker->country_code }} @endslot
                @endcomponent
            @endforeach
        </div>
    </div>
</section>
