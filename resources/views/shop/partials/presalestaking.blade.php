<h3 style="color: white;">Staking in progress</h3>
<ul>
    <li style="color: white;">Amount: {{ $st->tokens_to_stake }}</li>
    <li style="color: white;">Time:
        @switch($st->time)
            @case(1)
                1 Year (300%)
            @break
            @case(2)
                6 months (140%)
            @break
            @case(3)
                3 months (60%)
            @break
            @case(4)
                1 month (20%)
            @break
            @case(5)
                15 days (7%)
            @break
            @case(6)
                1 week (3%)
            @break

        @endswitch
    </li>
    <li style="color: white;">Requested at: {{ $st->created_at }} </li>
</ul>
