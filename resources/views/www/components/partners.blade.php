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
                        <a href="{{ $partner->website_url }}" target="_blank"><img src="{{ asset("$partner->image_url.webp") }}" alt="partner {{ $partner->name }}"></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
