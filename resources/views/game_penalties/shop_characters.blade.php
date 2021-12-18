@extends('layouts.play')

@section('content')
    <main class="min-h-screen h-full bg-cover bg-center "
        style="background-image: url({{ asset(img/game_penalties/bg-goalstadium.webp) }})">
        <section class="container mx-auto">
            <!-- Sidebar responsive /start -->
            <button id="btn-menu" class="text-slate-50 bg-goal-blue-200 bg-opacity-50 p-2 z-30 absolute lg:hidden flex "><svg
                    xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewbox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div id="bg-menu-responsive" class="bg-black fixed top-0 left-0 z-20 w-full h-full bg-opacity-80 hidden ">
                <aside
                    id="sidebar-responsive"
                    class="bg-black border border-goal-blue-200 shadow-aside min-h-screen bg-opacity-50 fixed z-30 flex flex-col p-4 w-10/12">
                    <h2 class="text-5xl text-slate-50 text-center py-8 tracking-wide">Shop</h2>
                    <div>
                        <ul class="text-slate-50 space-y-5">
                            <li> <a href="#characters" class="py-2 px-5 z-20 items-menu flex items-center"><img
                                        src="{{ asset('img/icons/character-icon.svg') }}" alt="Character icon">Characters</a></li>
                            <li> <a href="#locker" class="py-2 px-5 z-20 items-menu flex items-center"><img
                                        src="{{ asset('img/icons/rng-icon.svg') }}" alt="RNG Locker icon">RNG Locker</a></li>
                            <li> <a href="#items" class="py-2 px-5 z-20 items-menu flex items-center"><img
                                        src="{{ asset('img/icons/items-icon.svg') }}" alt="Items icon">Items</a></li>
                            <li> <a href="{{ route('penalties') }}" class="py-2 px-5 z-20 items-menu flex items-center text-slate-50"><img
                                        src="{{ asset('img/icons/home-icon.svg') }}" alt="Items icon">Home</a></li>
                        </ul>
                    </div>
                </aside>
            </div>
            <!-- Sidebar responsive /end -->
            <div class="grid grid-flow-col lg:grid-cols-4 grid-cols-1">
                <!-- Sidebar /start -->
                <aside
                    class="aside">
                    <h2 class="text-5xl text-slate-50 text-center py-8 tracking-wide">Shop</h2>
                    <div>
                        <ul class="text-slate-50 space-y-5">
                            <li> <a href="#characters" class="py-2 px-5 z-20 items-menu flex items-center"><img
                                        src="{{ asset('img/icons/character-icon.svg') }}" alt="Character icon">Characters</a></li>
                            <li> <a href="#locker" class="py-2 px-5 z-20 items-menu flex items-center"><img
                                        src="{{ asset('img/icons/rng-icon.svg') }}" alt="RNG Locker icon">RNG Locker</a></li>
                            <li> <a href="#items" class="py-2 px-5 z-20 items-menu flex items-center"><img
                                        src="{{ asset('img/icons/items-icon.svg') }}" alt="Items icon">Items</a></li>
                        </ul>
                    </div>
                </aside>
                <!-- Sidebar /end -->
                <!-- Content Shop /start -->
                <div class="lg:col-span-3 col-auto lg:flex lg:flex-col block mx-auto w-full">
                    <!-- Top buttons /start -->
                    <div class="flex lg:flex-row flex-col-reverse items-end lg:space-x-5 space-x-0 self-end my-2">
                        <div class="lg:flex items-center lg:space-x-5 space-x-0 space-y-2 lg:space-y-0 m-3 ">
                            <div class="btn-top-goal">
                                <img src="{{ asset(img/logo.webp) }}" alt="Goal stadium logo" class="w-12">
                                <span class="inline-flex pr-4">20</span>
                                <div class="h-8 w-8 rounded-full bg-white flex items-center justify-center cursor-pointer">
                                    <img src="{{ asset('img/icons/plus-icon.svg') }}" alt="Plus icon" class="w-3/5">
                                </div>
                            </div>
                            <div class="btn-top-goal">
                                <img src="{{ asset(img/logo.webp) }}" alt="Goal stadium logo" class="w-12">
                                <span class="inline-flex pr-4">20</span>
                                <div class="h-8 w-8 rounded-full bg-white flex items-center justify-center cursor-pointer">
                                    <img src="{{ asset('img/icons/plus-icon.svg') }}" alt="Plus icon" class="w-3/5">
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('penalties') }}" class="bg-white rounded-full p-2 border-4 border-goal-gray-100 btn-back">
                            <img src="{{ asset('img/icons/back-icon.svg') }}" alt="Back icon" class="w-8">
                        </a>
                    </div>
                    <!-- Top buttons /end -->
                    <!-- Divisions /start -->
                    <div class="self-center lg:mt-6 my-5 lg:space-y-2 space-y-4 flex flex-col items-center">
                        <!-- First division /start -->
                        <div class="lg:w-auto w-9/12 ">
                            <div class="flex items-center">
                                <h3 class="title-division">1st division</h3>
                                <div class="lg:hidden block ml-4">
                                    <img src="{{ asset('img/icons/scroll-icon.svg') }}" alt="Scroll Icon" class="w-8">
                                </div>
                            </div>
                            <ul class="flex items-center space-x-4 overflow-x-auto card-scroll lg:p-0 py-5 px-2 bg-black lg:bg-transparent bg-opacity-20 rounded">
                            @foreach ($products[1] as $product)
                                <li class="card-goal">
                                    <img src="{{ asset('img/game_penalties/card.svg') }}" alt="Card" class="lg:w-28 w-36 relative">
                                    <span class="price-card">$ {{ optional($product)->price }}</span>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                        <!-- First division /end -->
                        <!-- Second division /start -->
                        <div class="flex items-center lg:w-auto w-9/12 justify-center">
                            <button id="btn-l-second" class="relative lg:block hidden top-5 btn-swiper">
                                <img src="{{ asset('img/icons/left-arrow.svg') }}" alt="Left arrow" class="w-16">
                            </button>
                            <div class="w-full w-division">
                                <div class="flex items-center">
                                    <h3 class="title-division">2nd division</h3>
                                    <div class="lg:hidden block ml-4">
                                        <img src="{{ asset('img/icons/scroll-icon.svg') }}" alt="Scroll Icon" class="w-8">
                                    </div>
                                </div>
                                <ul id="second-division" class="flex items-center space-x-4 overflow-x-auto card-scroll lg:p-0 py-5 px-2 bg-black lg:bg-transparent bg-opacity-20">
                                @foreach ($products[2] as $product)
                                    <li class="card-goal">
                                        <img src="{{ asset('img/game_penalties/card.svg') }}" alt="Card" class="lg:w-28 w-36 relative">
                                        <span class="price-card">$ {{ optional($product)->price }}</span>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                            <button id="btn-r-second" class="relative lg:block hidden top-5 left-2 btn-swiper">
                                <img src="{{ asset('img/icons/right-arrow.svg') }}" alt="Right arrow" class="w-16">
                            </button>
                        </div>
                        <!-- Second division /end -->
                        <!-- Third division /start -->
                        <div class="flex items-center lg:w-auto w-9/12 justify-center">
                            <button id="btn-l-third" class="relative lg:block hidden top-5 btn-swiper">
                                <img src="{{ asset('img/icons/left-arrow.svg') }}" alt="Left arrow" class="w-16">
                            </button>
                            <div class="w-full w-division">
                                <div class="flex items-center">
                                    <h3 class="title-division">3rd division</h3>
                                    <div class="lg:hidden block ml-4">
                                        <img src="{{ asset('img/icons/scroll-icon.svg') }}" alt="Scroll Icon" class="w-8">
                                    </div>
                                </div>
                                <ul id="third-division" class="flex items-center space-x-4 overflow-x-auto card-scroll lg:p-0 py-5 px-2 bg-black lg:bg-transparent bg-opacity-20 w-full">
                                @foreach ($products[3] as $product)
                                    <li class="card-goal">
                                        <img src="{{ asset('img/game_penalties/card.svg') }}" alt="Card" class="lg:w-28 w-36 relative">
                                        <span class="price-card">$ {{ optional($product)->price }}</span>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                            <button id="btn-r-third" class="relative lg:block hidden top-5 left-2 btn-swiper"><img
                                    src="{{ asset('img/icons/right-arrow.svg') }}" alt="Right arrow" class="w-16"></button>
                        </div>
                        <!-- Third division /end -->
                    </div>
                    <!-- Divisions /end -->
                </div>
                <!-- Content Shop /end -->
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js/shop_characters.js') }}" type="module"></script>
@endsection
