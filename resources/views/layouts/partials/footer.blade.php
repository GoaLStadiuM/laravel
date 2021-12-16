<footer>
    <div class="container-fluid">
      <div class="row footer-wrapper justify-content-evenly">
        <div class="col-sm-4 col-md-4 col-lg-4 footer-logo">
          <a href=""><img class="img-fluid" src="{{ asset('img/Toon-style.webp') }}" alt=""></a>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 align-self-center text-center footer-social-media">
            <div class="footer-mail my-5">
                <a class="fs-5 c-link" href="mailto:info@goalstadium.com">info@goalstadium.com</a><br>
                <a class="fs-5 c-link" href="mailto:youtubers@goalstadium.com">youtubers@goalstadium.com</a>
            </div>
          <ul class="list-group list-group-horizontal social-media d-flex justify-content-center">
                  <li class="list-group-item c-link cursor-content">
                    <a href="{{ $facebook_url }}" class="social-facebook" target="_blank">
                       @include('layouts.svg.facebook')
                    </a>
                </li>
                <li class="list-group-item c-link cursor-content">
                    <a href="{{ $instagram_url }}" class="social-instagram" target="_blank">
                      @include('layouts.svg.instagram')
                    </a>
                </li>
                <li class="list-group-item c-link cursor-content">
                  <a href="{{ $twitter_url }}" class="social-twitter" target="_blank">
                    @include('layouts.svg.twitter')
                  </a>
                </li>
                <li class="list-group-item c-link cursor-content">
                  <a href="{{ $discord_url }}" class="social-discord" target="_blank">
                    @include('layouts.svg.discord')
                  </a>
              </li>
              <li class="list-group-item c-link cursor-content">
                  <a href="{{ $youtube_url }}" class="social-youtube" target="_blank">
                    @include('layouts.svg.youtube')
                  </a>
              </li>
              <li class="list-group-item c-link cursor-content">
                <a href="{{ $telegram_url }}" class="social-telegram" target="_blank">
                    @include('layouts.svg.telegram')
                </a>
              </li>
          </ul>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 footer-Terms d-flex justify-content-center ">
          <p class="fs-p cursor-content">© 2021 GoaL StadiuM</p>
        </div>
      </div>
    </div>
</footer>
