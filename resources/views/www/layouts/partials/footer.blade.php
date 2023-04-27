<div class="footer-top footer-bg third-footer-bg">
    <div class="container custom-container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <div class="footer-widget mb-50">
                    <div class="logo mb-35">
                        <a href="{{ route('home') }}"><img src="{{ asset('img/footer-left.webp') }}" alt="" width="400"></a>
                    </div>
                    <div class="fw-text">
                        <p>Un juego global inspirado en las más puras y grandiosas ligas del panorama futbolístico internacional actual, que proporciona una experiencia de juego totalmente nueva y muy original que irá evolucionando día a día.</p>
                        <div class="fw-social">
                            <ul>
                                <li><a href="{{ $twitter_url }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="{{ $instagram_url }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="{{ $facebook_url }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="{{ $discord_url }}" target="_blank"><i class="fab fa-discord"></i></a></li>
                                <li><a href="{{ $youtube_url }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                <li><a href="{{ $telegram_url }}" target="_blank"><i class="fab fa-telegram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-5">
                <div class="footer-widget text-right mb-50">
                    <div class="fw-title mb-35">
                        <h3>Enlaces de <span>Interés</span></h3>
                    </div>
                    <div class="fw-quick-link">
                        <ul>
                            <li>
                                <a>Whitepaper</a>
                                <ul class="submenu">
                                    <li><a href="{!! asset('documents/whitepaper_en.pdf') !!}" target="_blank">English</a></li>
                                    <li><a href="{!! asset('documents/whitepaper_es.pdf') !!}" target="_blank">Spanish</a></li>
                                    <li><a href="{!! asset('documents/whitepaper_pt.pdf') !!}" target="_blank">Portuguese</a></li>
                                </ul>
                            </li>
                            <!-- <li><a href="{!! asset('documents/AuditoriaTOKEN.pdf') !!}" target="_blank">Auditorias</a></li> -->
                            <!-- <li><a href="{{ $contract_address_url }}" target="_blank">Contrato Goal</a></li> -->
                            <li><a href="{{ route('legal') }}">Aviso Legal</a></li>
                            <li><a href="{{ route('privacy') }}">Política de Privacidad</a></li>
                            <li><a href="{{ route('cookies') }}">Política de Cookies</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="copyright-wrap third-copyright-wrap">
    <div class="container custom-container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="copyright-text">
                    <p>Copyright © {{ date('Y') }} <a>{{ config('app.name') }}</a> All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>
