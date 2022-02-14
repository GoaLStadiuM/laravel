<div class="brand-area t-brand-bg" id="partners">
    <div class="col-12">
        <div class="third-section-title text-center mb-60">
            <h2>Partners</h2>
        </div>
    </div>
    <div class="container custom-container">
        <div class="row s-brand-active">
            @foreach($partners as $partner)
                <div class="col-12">
                    <div class="t-brand-item">
                        <img src="{{ asset("$partner->img_url.webp") }}" alt="">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
