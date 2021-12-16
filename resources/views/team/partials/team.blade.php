<section class="section-team">
    <div class="container">
      <div class="row team-wrapper">
        <div class="row row-cols-1 row-cols-md-4 g-4 mt-5 ">
            @component('team.components.teammember')
                @slot('img') {{ asset('img/team/f1.webp') }} @endslot
                @slot('name') Javier Boyer @endslot
                @slot('position') COO / Cofounder @endslot
            @endcomponent

            @component('team.components.teammember')
                @slot('img') {{ asset('img/team/f2.webp') }} @endslot
                @slot('name') Luis Gralla @endslot
                @slot('position') CFO / Mathematician @endslot
            @endcomponent

            @component('team.components.teammember')
                @slot('img') {{ asset('img/team/f3.webp') }} @endslot
                @slot('name') Julian Tejeda @endslot
                @slot('position') CMO / Cofounder @endslot
            @endcomponent

            @component('team.components.teammember')
                @slot('img') {{ asset('img/team/f4.webp') }} @endslot
                @slot('name') Pietro Conti @endslot
                @slot('position') Ciberseguridad @endslot
            @endcomponent
        </div>
        <div class="row row-cols-1 row-cols-md-4 g-4 mt-5 d-flex justify-content-center">
            @component('team.components.teammember')
            @slot('img') {{ asset('img/team/f5.webp') }} @endslot
            @slot('name') Lucio Tena @endslot
            @slot('position') Community Manager @endslot
            @endcomponent

            @component('team.components.teammember')
                @slot('img') {{ asset('img/team/f6.webp') }} @endslot
                @slot('name') Jose Antonio Almenara @endslot
                @slot('position') CCO @endslot
            @endcomponent

            @component('team.components.teammember')
                @slot('img') {{ asset('img/team/f7.webp') }} @endslot
                @slot('name') Francisco Campana @endslot
                @slot('position') CHRO @endslot
            @endcomponent

            @component('team.components.teammember')
                @slot('img') {{ asset('img/team/f8.webp') }} @endslot
                @slot('name') Gabriel Blanca  @endslot
                @slot('position') CTO / Cofounder @endslot
            @endcomponent

            @component('team.components.teammember')
                @slot('img') {{ asset('img/team/f9.webp') }} @endslot
                @slot('name') Oscar Gralla  @endslot
                @slot('position') CEO / Founder @endslot
            @endcomponent
        </div>
      </div>
    </div>
</section>
