<section class="section-scroll-animation">
    <div class="container-fluid scroll-wrapper">
      <div class="row animation-div-one">
        <div class="col-sm-6 offset-sm-1 col-md-5 offset-md-2 col-lg-5 offset-lg-2  ronaldo-avatar">
          <img class="img-fluid" src="{{ asset('img/landing/opiver.webp') }}" alt="">
        </div>
      </div>
      <div class="row animation-div-two">
          <div class="ball-translation" id="ball-translation">
            <div class="col-sm-2 offset-sm-0 col-md-2 offset-md-3 col-lg-2 offset-lg-5 ball">
            <img class="img-fluid" src="{{ asset('img/landing/ball.webp') }}" alt="">
            </div>
        </div>
        <div class="col-sm-6 offset-sm-6 col-md-5 offset-md-7 col-lg-5 offset-lg-7 goal-keeper-avatar">
          <img class="img-fluid" src="{{ asset('img/landing/goal-keeper.webp') }}" alt="">
        </div>
      </div>
    </div>
  </section>

  <script>
    var e = document.getElementById("ball-translation");
    e.addEventListener("animationstart", listener, false);
    e.addEventListener("animationend", listener, false);

    e.className = "transition";

    function listener(e)
    {
        switch(e.type) {
            case "animationstart":
            console.log("start");
              break;
            case "animationend":
              console.log("end");
              break;
        }
    }
  </script>
