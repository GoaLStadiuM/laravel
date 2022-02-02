<section style="background-color: #040b14; color:white !important;">
<div class="py-5 team4">
    <div class="container">
      <div class="row justify-content-center mb-4">
        <div class="col-md-7 text-center">
          <h1 class="fs-1 cursor-content" style="color: white;">{{ __('web.collaborators') }}</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 mb-4">
          @component('partner.components.team')
            @slot('img') {{ asset('img/partner/colab_manel.webp') }}  @endslot
            @slot('name') Manel Nuñez @endslot
            @slot('designation') Discord Manager @endslot
            @slot('flag') es @endslot
          @endcomponent
        </div>
        <div class="col-lg-4 mb-4">
          @component('partner.components.team')
            @slot('img') {{ asset('img/partner/colab_fabian.webp') }} @endslot
            @slot('name') Fabian Camacho @endslot
            @slot('designation') Telegram Mod @endslot
            @slot('flag') mx @endslot
          @endcomponent
        </div>
        <div class="col-lg-4 mb-4">
          @component('partner.components.team')
            @slot('img') {{ asset('img/partner/colab_cesar.webp') }} @endslot
            @slot('name') César Villaroya @endslot
            @slot('designation') Telegram Mod @endslot
            @slot('flag') es @endslot
          @endcomponent
        </div>
      </div>
      <div class="row" style="text-align: center">
        <div class="col-lg-6 mb-4">
          @component('partner.components.team')
            @slot('img') {{ asset('img/partner/colab_diego.webp') }} @endslot
            @slot('name') Diego Zanni @endslot
            @slot('designation') Telegram Mod @endslot
            @slot('flag') ar @endslot
          @endcomponent
        </div>
        <div class="col-lg-6 mb-4">
          @component('partner.components.team')
            @slot('img') {{ asset('img/partner/colab_andrea.webp') }} @endslot
            @slot('name') Andrea Gómez @endslot
            @slot('designation') Telegram Mod @endslot
            @slot('flag') ve @endslot
          @endcomponent
        </div>
        <div class="col-lg-6 mb-4">
          @component('partner.components.team')
            @slot('img') {{ asset('img/partner/colab_jose.webp') }} @endslot
            @slot('name') José Salcedo @endslot
            @slot('designation') Telegram Mod @endslot
            @slot('flag') ve @endslot
          @endcomponent
        </div>
          <div class="col-lg-6 mb-4">
              @component('partner.components.team')
                  @slot('img') {{ asset('img/partner/tiktoker_viverdejogo.webp') }} @endslot
                  @slot('name') Viverdejogo @endslot
                  @slot('designation') TikToker @endslot
                  @slot('flag') br @endslot
              @endcomponent
          </div>
          <div class="col-lg-6 mb-4">
              @component('partner.components.team')
                  @slot('img') {{ asset('img/partner/tiktoker_cryptoaddict.webp') }} @endslot
                  @slot('name') Crypto Addict @endslot
                  @slot('designation') TikToker | Youtuber @endslot
                  @slot('flag') br @endslot
              @endcomponent
          </div>
      </div>
    </div>
  </div>
</section>
