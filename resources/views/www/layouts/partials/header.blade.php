<div class="bg"></div>
<div class="container custom-container">
    <div class="header-top-area t-header-top-area d-none d-lg-block">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-top-social">
                    <ul>
                        <li>Síguenos</li>
                        <li><a href="{{ $twitter_url }}"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="{{ $instagram_url }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="{{ $facebook_url }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="{{ $discord_url }}" target="_blank"><i class="fab fa-discord"></i></a></li>
                        <li><a href="{{ $youtube_url }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="{{ $telegram_url }}" target="_blank"><i class="fab fa-telegram"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="header-top-login">
                    <ul>
                        <!-- <li><a href="#"><i class="fas fa-wallet"></i>Wallet</a></li> -->
                        @if (\Illuminate\Support\Facades\Auth::check())
                        <li>
                            <a href="#"><i class="fas fa-user"></i>Usuario</a>
                            <ul class="submenu">
                                <li><a href="{{ route('user') }}">Ajustes Usuario</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li><a href="{{ route('register')}}"><i class="far fa-edit"></i>Registrarse</a></li>
                        <li class="or">or</li>
                        <li><a href="{{ route('login')}}"><i class="far fa-edit"></i>sign in</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="sticky-header">
    <div class="container custom-container">
        <div class="row">
            <div class="col-12">
                <div class="main-menu menu-style-two">
                    <nav>
                        <div class="logo d-block d-lg-none">
                            <a href="{{ route('home')}}"><img src="{{ asset('img/logo.webp') }}" alt="Logo" width="75"></a>
                        </div>
                        <div class="navbar-wrap d-none d-lg-flex">
                            <ul class="left">
                                <li{{ request()->routeIs('home') ? ' class=show' : '' }}><a href="{{ route('home') }}">Inicio</a></li>
                                <li><a href="{{ route('home').'#bienvenidos' }}">Bienvenidos</a></li>
                                <li><a href="{{ route('home').'#metaverso' }}">Metaverso</a></li>
                                <li><a href="{{ route('home').'#play2earn' }}">Play<span>2Earn</span></a></li>
                                <li><a href="{{ route('home').'#nfts' }}">Nfts</a></li>
                            </ul>
                            <div class="logo">
                                <a href="{{ route('home') }}"><img src="{{ asset('img/logo.webp') }}" alt="Logo" width="125"></a>
                            </div>
                            <ul class="right">
                                <li><a href="{{ route('home').'#farming' }}">Farming/Staking</a></li>
                                <li{{ request()->routeIs('collaborators') ? ' class=show' : '' }}><a href="{{ route('collaborators') }}">Colaboradores</a></li>
                                <li{{ request()->routeIs('rankings') ? ' class=show' : '' }}><a href="{{ route('rankings') }}">Clasificaciones</a></li>
                                <li>
                                    <a href="#">Whitepaper</a>
                                    <ul class="submenu">
                                        <li><a href="{!! asset('documents/whitepaper_en.pdf') !!}" target="_blank">English</a></li>
                                        <li><a href="{!! asset('documents/whitepaper_es.pdf') !!}" target="_blank">Spanish</a></li>
                                        <li><a href="{!! asset('documents/whitepaper_pt.pdf') !!}" target="_blank">Portuguese</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="mobile-menu-wrap d-block d-lg-none">
                    <nav>
                        <div class="mobile-top-login d-lg-none">
                            <ul>
                                <!-- <li><a href="#"><i class="fas fa-wallet"></i>Wallet</a></li> -->
                                @if (\Illuminate\Support\Facades\Auth::check())
                                <li>
                                    <a href="#"><i class="fas fa-user"></i>Usuario</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('user') }}">Ajustes Usuario</a></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                @else
                                <li><a href="{{ route('register')}}"><i class="far fa-edit"></i>Registrarse</a></li>
                                <li class="or">or</li>
                                <li><a href="{{ route('login')}}"><i class="far fa-edit"></i>sign in</a></li>
                                @endif
                            </ul>
                        </div>
                        <div id="mobile-menu" class="navbar-wrap">
                            <ul>
                                <li{{ request()->routeIs('home') ? ' class=show' : '' }}><a href="{{ route('home')}}">Inicio</a></li>
                                <li><a href="{{ route('home').'#bienvenidos'}}">Bienvenidos</a></li>
                                <li><a href="{{ route('home').'#metaverso'}}">Metaverso</a></li>
                                <li><a href="{{ route('home').'#play2earn'}}">Play<span>2Earn</span></a></li>
                                <li><a href="{{ route('home').'#nfts'}}">Nfts</a></li>
                                <li><a href="{{ route('home').'#farming'}}">Farming/Staking</a></li>
                                <li{{ request()->routeIs('collaborators') ? ' class=show' : '' }}><a href="{{ route('collaborators') }}">Colaboradores</a></li>
                                <li{{ request()->routeIs('rankings') ? ' class=show' : '' }}><a href="{{ route('rankings') }}">Clasificaciones</a></li>
                                <li>
                                    <a href="#">Whitepaper</a>
                                    <ul class="submenu">
                                        <li><a href="{!! asset('documents/whitepaper_en.pdf') !!}" target="_blank">English</a></li>
                                        <li><a href="{!! asset('documents/whitepaper_es.pdf') !!}" target="_blank">Spanish</a></li>
                                        <li><a href="{!! asset('documents/whitepaper_pt.pdf') !!}" target="_blank">Portuguese</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="mobile-menu"></div>
            </div>
        </div>
    </div>
</div>
<div class="header-bottom-bg"></div>
