@extends('layouts.www')

@section('content')
    @include('landing.partials.slider')
    @include('landing.partials.video')
    @include('landing.partials.trainingvideo')
    @include('landing.partials.play')
    @include('landing.partials.restingvideo')
    @include('landing.partials.characters')
@endsection

@section('styles')
    <!-- swiper -->
    <link rel="stylesheet" href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}">

    <!-- vimeo player -->
    <!-- <link rel="stylesheet" href="{{ asset('vendor/plyr/dist/plyr.css') }}"> -->

    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('css/character-slider.css') }}">
@endsection

@section('scripts')
    <!-- vimeo player -->
    <!-- <script src="{{ asset('vendor/plyr/dist/plyr.min.js') }}"></script> -->
    <script src="https://player.vimeo.com/api/player.js"></script>

    <!-- ScrollTrigger -->
    <script src="{{ asset('vendor/gsap/dist/ScrollTrigger.min.js') }}"></script>

    <!-- swiper -->
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('js/landing.js') }}"></script>
@endsection
