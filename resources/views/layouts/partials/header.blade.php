<header class="fixed-top container-fluid">
    <a id="brand-logo" href="{{ route('landing') }}">
        <img src="{{ asset('img/logo.webp') }}" alt="goalstadium logo">
    </a>
    <nav id="wallet-btns">
        <div class="aux-mobile-bar">
            <a class="fs-p earn-btn position-relative" href="{{ route('menu') }}">Play2Earn</a>
        </div>
        <a class="fs-p balance-btn menu-top-btn-big" href="">
            <img class="me-3" src="{{ asset('img/logo.webp') }}" width=24 alt="goal icon">
            <span>0.00 GoaL</span>
            @include('layouts.svg.soccerball')
            <span>0.00 GLS</span>
        </a>
        <a class="fs-p earn-btn menu-top-btn-big position-relative" href="{{ route('menu') }}">Play2Earn</a>
        <a class="fs-p wallet-btn menu-top-btn-big" href="">
            <span>WALLET</span>
            @include('layouts.svg.wallet')
        </a>
    </nav>
    @include('layouts.svg.menu')
    <div class="nav-container">
        @include('layouts.svg.menuclose')
        @include('layouts.partials.menu')
    </div>
</header>
