@extends('www.layouts.web')

@section('title', 'Inicio')

@section('content')
    <!-- landing-area -->
    @include('www.home.partials.landing')
    <!-- landing-area-end -->

    <!-- welcome-area -->
    @include('www.home.partials.welcome')
    <!-- welcome-area-end -->

    <!-- play2earn-area -->
    @include('www.home.partials.play2earn')
    <!-- play2earn-area-end -->

    <!-- farming-area -->
    @include('www.home.partials.farming')
    <!-- farming-area-end -->

    <!-- staking-area -->
    @include('www.home.partials.staking')
    <!-- staking-area-end -->

    <!-- partners-area -->
    @include('www.components.partners')
    <!-- partners-area-end -->

    <!-- contact-area -->
    @include('www.home.partials.contact')
    <!-- contact-area-end -->
@endsection
