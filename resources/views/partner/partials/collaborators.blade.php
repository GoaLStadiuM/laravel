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
                        @slot('img') {{ asset('img/partner/colab_jose.webp') }} @endslot
                        @slot('name') José Salcedo @endslot
                        @slot('designation') Discord y Telegram Mod @endslot
                        @slot('flag') ve @endslot
                    @endcomponent
                </div>
                <div class="col-lg-4 mb-4">
                    @component('partner.components.team')
                        @slot('img') {{ asset('img/partner/colab_yuraimaalastre.webp') }} @endslot
                        @slot('name') Yuraima Alastre @endslot
                        @slot('designation') Discord y Telegram Mod @endslot
                        @slot('flag') ve @endslot
                    @endcomponent
                </div>
                <div class="col-lg-6 mb-4">
                    @component('partner.components.team')
                        @slot('img') {{ asset('img/partner/colab_oscarluna.webp') }} @endslot
                        @slot('name') Oscar Luna @endslot
                        @slot('designation') Discord y Telegram Mod @endslot
                        @slot('flag') ph @endslot
                    @endcomponent
                </div>
                <div class="col-lg-6 mb-4">
                    @component('partner.components.team')
                        @slot('img') {{ asset('img/partner/colab_lautarocanale.webp') }} @endslot
                        @slot('name') Lautaro Canale @endslot
                        @slot('designation') Discord y Telegram Mod @endslot
                        @slot('flag') ph @endslot
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
                        @slot('flag') ph @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</section>
