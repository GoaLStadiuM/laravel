@extends('www.layouts.web')

@section('title', 'Aviso Legal')

@section('content')
    <!-- breadcrumb-area -->
    @component('www.components.breadcrumbs')
        @slot('title') Aviso <span>Legal</span> @endslot
        @slot('name') Legal @endslot
    @endcomponent
    <!-- breadcrumb-area-end -->

    <!-- TODO: cookies-text -->
    <section class="inner-about-area fix">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="section-title title-style-three mb-25">
                        <h2>released <span>GAMES</span></h2>
                    </div>
                    <div class="inner-about-content">
                        <h5>Monica Global Publishing for Marketing</h5>
                        <p>Compete with 100 players on a remote Lorem Ipsn gravida. Pro ain gravida nibh vel velit an auctor aliqueenean
                        ollicitudin ain gravida nibh vel version an ipsum.</p>
                        <p>Lorem Ipsn gravida. Pro ain gravida nibh vevelit auctor aliqueenean ollicitudin ain gravida nibh vel version an ipsum.</p>
                        <a href="#" class="btn btn-style-two">BUY THEME</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="inner-about-shape"><img src="img/images/medale_shape.png" alt=""></div>
    </section>
    <!-- cookies-text-end -->
@endsection
