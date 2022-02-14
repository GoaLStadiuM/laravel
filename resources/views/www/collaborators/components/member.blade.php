<div class="col-lg-3 col-sm-6">
    <div class="team-member-box text-center mb-50">
        <div class="team-member-thumb">
            <img src="{{ $img }}" alt="member">
        </div>
        <div class="team-member-content">
            <h4><a href="#">{{ $name }}</a></h4>
            <span>{{ $title }}</span>
            @component('www.components.flag')
                @slot('width') 32 @endslot
                @slot('format') 4x3 @endslot
                @slot('flag') {{ $flag }} @endslot
            @endcomponent
            @if (isset($flag2))
                @component('www.components.flag')
                    @slot('width') 32 @endslot
                    @slot('format') 4x3 @endslot
                    @slot('flag') {{ $flag2 }} @endslot
                @endcomponent
            @endif
        </div>
    </div>
</div>
