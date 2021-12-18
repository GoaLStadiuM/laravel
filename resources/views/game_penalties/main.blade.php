@extends('layouts.play')

@section('content')
    <main class="min-h-screen bg-cover bg-center flex flex-col relative" style="background-image: url({{ asset('img/game_penalties/bg-goalstadium.webp') }})">
        <!-- Goalkeeper Image /start -->
        <img src="{{ asset(img/game_penalties/goalkeeper.webp) }}" alt="Goalkeeper" class="absolute md:w-1/3 w-full h-auto top-28 right-40 z-0">
        <img src="{{ asset(img/game_penalties/football.webp) }}" alt="Football" class="absolute w-20 h-20 top-14 right-28 z-0 ball-blur">
        <!-- Goalkeeper Image /end -->
        <!-- Logo /start -->
        <div class="z-20">
            <img src="{{ asset(img/game_penalties/logo.webp) }}" alt="GoaL StadiuM logo" class="bg-auto md:w-1/3 w-1/2 mx-auto z-20">
        </div>
        <!-- Logo /end -->

        <!-- Menu /start -->
        <div class="self-center space-y-4 flex flex-col md:w-1/3 w-9/12 z-20">
            <a href="#game" class="text-slate-50 text-4xl text-center uppercase tracking-wider bg-gradient p-4 btn-svg">Play game</a>
            <a href="#characters" class="text-slate-50 text-4xl text-center uppercase tracking-wider bg-gradient p-4 btn-svg">Character List</a>
            <a href="#marketplace" class="text-slate-50 text-4xl text-center uppercase tracking-wider bg-gradient p-4 btn-svg">Marketplace</a>
            <a href="{{ route('shop_characters') }}" class="text-slate-50 text-4xl text-center uppercase tracking-wider bg-gradient p-4 btn-svg">Shop</a>
        </div>
        <!-- Menu /end -->
    </main>
@endsection
