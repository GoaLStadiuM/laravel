@extends('play.layouts.penalties')

@section('title', 'Menu')

@section('styles')
    <!-- custom -->
    <link rel="stylesheet" href="{{ asset('css/penalties.css') }}">
@endsection

@section('content')
    <main class="min-h-screen bg-cover bg-center flex flex-col relative" style="background-image: url({{ asset('img/bg/bg-goalstadium.webp') }})">
        <!-- Goalkeeper Image /start -->
        <img src="{{ asset('img/penalties/goalkeeper.webp') }}" alt="Goalkeeper" class="absolute md:w-1/3 w-full h-auto top-28 right-40 z-0">
        <img src="{{ asset('img/penalties/football.webp') }}" alt="Football" class="absolute w-20 h-20 top-14 right-28 z-0 ball-blur">
        <!-- Goalkeeper Image /end -->
        <!-- Logo /start -->
        <div class="z-20">
            <a href="{{ route('landing') }}"><img src="{{ asset('img/penalties/logo.webp') }}" alt="GoaL StadiuM logo" class="bg-auto md:w-1/3 w-1/2 mx-auto z-20"></a>
        </div>
        <!-- Logo /end -->

        <!-- Menu /start -->
        <div class="self-center space-y-4 flex flex-col md:w-1/3 w-9/12 z-20">
            <a href="{{ asset('game/penalties/GOALSTADIUM_v1.1_winx64.zip') }}" target="_blank" class="text-slate-50 text-4xl text-center uppercase tracking-wider bg-gradient p-4 btn-svg">Download game</a>
            <a href="{{ route('click2earn') }}" class="text-slate-50 text-4xl text-center uppercase tracking-wider bg-gradient p-4 btn-svg">Click2Earn</a>
            <a href="#characters" class="text-slate-50 text-4xl text-center uppercase tracking-wider bg-gradient p-4 btn-svg">Character List</a>
            <a href="#marketplace" class="text-slate-50 text-4xl text-center uppercase tracking-wider bg-gradient p-4 btn-svg">Marketplace</a>
            <a href="{{ route('shop') }}" class="text-slate-50 text-4xl text-center uppercase tracking-wider bg-gradient p-4 btn-svg">Shop</a>
        </div>
        <!-- Menu /end -->
    </main>
@endsection
