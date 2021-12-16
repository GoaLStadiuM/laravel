<figure class="text-center">
    <img src="{{ $img }}" alt="wrapkit" class="img-fluid rounded-circle">
    <figcaption>
        <h5 class="mt-4 font-weight-medium mb-0" style="color: white;">{{ $name }}</h5>
        <h6 class="subtitle mb-3">{{ $designation }}</h6>
        @component('components.flag')
            @slot('width') 32 @endslot
            @slot('format') 4x3 @endslot
            @slot('flag') {{ $flag }} @endslot
        @endcomponent
        @if (isset($flag2))
        @component('components.flag')
            @slot('width') 32 @endslot
            @slot('format') 4x3 @endslot
            @slot('flag') {{ $flag2 }} @endslot
        @endcomponent
        @endif
    </figcaption>
</figure>
