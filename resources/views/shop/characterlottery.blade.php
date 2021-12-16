<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>GoaL StadiuM - Character</title>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"
    />

    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />


    <style>
      html,
      body {
        position: relative;
        height: 100%;
      }

      body {
        background: #eee;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color: #000;
        margin: 0;
        padding: 0;
        background-color: #000;
      }

      .swiper {
        width: 100%;
        height: 100%;
      }

      .swiper-slide {
        text-align: center;
        font-size: 18px;
      /*  width: 256px !important;*/
        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
      }

      .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .div-name-bg {
        margin-top: 50px;
        margin-bottom: 50px;
        position: relative;
        text-align: center;
      }

      .div-name {
        color: white;
        position: relative;
        top: -95px;
        width: 100%;
        text-align: center;
      }

      video {
        height: 100%;
        width: 177.77777778vh; /* 100 * 16 / 9 */
        min-width: 100%;
        min-height: 56.25vw; /* 100 * 9 / 16 */
      }
    </style>
  </head>

  <body>
    <div style="width: 100%; height: 10%;">
    </div>
    <!-- Swiper -->
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img src="{{ asset('img/character/01.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/02.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/03.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/04.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/05.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/06.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/07.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/08.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/09.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/10.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/11.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/12.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/13.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/14.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/15.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/16.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/17.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/18.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/19.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/20.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/21.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/22.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/23.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/24.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/25.webp') }}">
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('img/character/26.webp') }}">
          </div>
      </div>
    </div>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        start = false;
     // setTimeout(function(){ window.location.href="/purchases"; }, 5000);
        setTimeout(function(){ start = true; }, 5000);
        setTimeout(function(){ window.location.href="/purchases"; }, 25000);

      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 30,
        loop: true,
        centeredSlides: true,
        autoplay: {
          delay: 1,
          disableOnInteraction: false,
        },
      });

      swiper.on("slideChange", function() {
        if( (swiper.activeIndex == {{ $character->id }}) && (start) )
        {
           console.log("Done");
           swiper.autoplay.stop();
           window.location.href="/purchases";
        }
      });
    </script>
  </body>
</html>
