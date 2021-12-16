<section class="stake-home">
    <div class="container-fluid">
      <div class="row stake-wrapper">
        <div class="col-sm-12 col-md-3 col-lg-3 align-self-end order-sm-1 duel-player">
          <img class="" src="{{ asset('img/stake/staking1.webp') }}" alt="">
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 align-self-center order-sm-2">
          <div class="invest-div" style="text-align: center;">
            <div class="invest-text">
              <h1 class="mb-3 fs-2 cursor-content">{{ __('web.Invest an amount') }} </h1>
            </div>
            <div class="time">
              <p class="fs-p cursor-content time-text mb-5">{{ __('web.Choose the time, More time = More Earnings') }}</p>
              <div class="choose-time">
                <div class="container">
                    <div class="row">
                      <div class="col-sm">

                            <input class="form-check-input c-form-input" type="radio" name="flexRadioDefault"
                              id="flexRadioDefault1" checked>
                            <label for="flexRadioDefault1" style="color: white; font-size:18px; padding-left: 10px; padding-top: 5px;">7 {{ __('web.Days') }}</label>

                      </div>
                      <div class="col-sm">
                        <input class="form-check-input c-form-input" type="radio" name="flexRadioDefault"
                      id="flexRadioDefault2">
                        <label style="color: white; font-size:18px; padding-left: 10px; padding-top: 5px;" for="flexRadioDefault2">1 {{ __('web.Month') }}</label>
                      </div>
                      <div class="col-sm">
                        <input class="form-check-input c-form-input" type="radio" name="flexRadioDefault"
                      id="flexRadioDefault3">
                        <label style="color: white; font-size:18px; padding-left: 10px; padding-top: 5px;" for="flexRadioDefault3">3 {{ __('web.Months') }}</label>
                      </div>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <div class="col">
                            <input class="form-check-input c-form-input" type="radio" name="flexRadioDefault"
                            id="flexRadioDefault4" style="margin-left: 50px;">
                            <label style="color: white; font-size:18px; padding-left: 10px; padding-top: 5px;" for="flexRadioDefault4">6 {{ __('web.Months') }} </label>
                        </div>
                        <div class="col">
                            <input class="form-check-input c-form-input" type="radio" name="flexRadioDefault"
                            id="flexRadioDefault5">
                            <label style="color: white; font-size:18px; padding-left: 10px; padding-top: 5px;" for="flexRadioDefault5" style="margin-right: 50px;">1 {{ __('web.Year') }}</label>
                        </div>
                      </div>
                  </div>

              </div>
              <div class="input-group c-input-grp time-result">
                <div>
                    <span class="input-group-text c-input-grp-txt fs-4 cursor-content">{{ __('web.You Choose 7days') }}</span>
                    <span class="input-group-text c-input-grp-txt fs-4 cursor-content">{{ __('web.Your Bonus % is') }}</span>
                </div>
                <div>
                   <span class="input-group-text c-input-grp-txt fs-1 cursor-content">30%</span>
                </div>
              </div>
            </div>
            <div class="invest-amount text-center">
              <h3 class="fs-3 text-uppercase cursor-content">{{ __('web.the amount to invest') }}</h3>
              <div class="input-group c-input-grp-2 flex-nowrap mt-3 mb-5">
                <input type="text" class="form-control fs-3 c-form-control" id="addon-wrapping" placeholder="$ 122" aria-label="addon-wrapping"
                  aria-describedby="addon-wrapping">
              </div>
              <div class="invest-btn-div">
                <a class="fs-p invest-btn" href="">{{ __('web.Invest') }}</a>
                <a class="fs-p invest-btn-2" href="">@include('stake.svg.wallet')</a>
                <a class="fs-p invest-btn-2" href="">@include('stake.svg.card')</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 align-self-center order-sm-3 lady-player">
          <img class="" src="{{  asset('img/stake/padel.webp') }}" alt="">
        </div>
      </div>
    </div>
</section>
