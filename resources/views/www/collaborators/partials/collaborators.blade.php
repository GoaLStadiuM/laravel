<section class="team-member-area pt-115 pb-125">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="section-title title-style-three text-center mb-70">
                    <h2>Nuestros <span>Colaboradores</span></h2>
                </div>
            </div>
        </div>
        <div class="row" style="justify-content: center;">
            @foreach($collaborators as $collaborator)
                @component('www.collaborators.components.member')
                    @slot('img') {{ asset("$collaborator->image_url.webp") }} @endslot
                    @slot('name') {{ $collaborator->name }} @endslot
                    @slot('title') {{ $collaborator->title }} @endslot
                    @slot('flag') {{ $collaborator->country_code }} @endslot
                @endcomponent
            @endforeach
        </div>
    </div>
</section>
