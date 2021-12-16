<ul style="color:white">
    <li>Locked (75%): <span style="color:red">{{ optional($token)->goal_tokens * .75 }} GoaL Tokens</span></li>
    <li>Unlocked (25%): <span style="color:green">{{ optional($token)->goal_tokens * .25 }} GoaL Tokens</span></li>
</ul>
<a href="{{ route('request.tokens', $token->id) }}" style="padding: 8px; background-image: url('{{ asset('img/bg_btn_header.png') }}'); color:white; border: 2px solid white; border-radius: 10px; background-size: cover;">Withdraw tokens to wallet</a>
<form method="post" action="{{ route('sent.staking.presale') }}">
    @csrf
    <input type="hidden" name="id" id="id" value="{{ $token->id }}">
    <select name="time" id="time">
        <option value="1">1 year (300%)</option>
        <option value="2">6 months (140%)</option>
        <option value="3">3 months (60%)</option>
        <option value="4">1 month (20%)</option>
        <option value="5">15 days (7%)</option>
        <option value="6">7 days (3%)</option>
    </select>
    <input type="submit" style="padding: 8px; background-image: url('{{ asset('img/bg_btn_header.png') }}'); color:white; border: 2px solid white; border-radius: 10px; background-size: cover;" value="Send tokens to Staking">
</form>
