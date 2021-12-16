<x-app-layout>
    <div class="w-full bg-black">
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 py-12">
            <div class="text-center pb-12">
                <h2 class="text-base font-bold text-indigo-600">
                    Purchases
                </h2>
                <h1 class="font-bold text-3xl md:text-4xl lg:text-5xl text-white">
                    MY CHARACTER
                </h1>

            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6">
                @foreach($payments as $payment)
                <div class="w-full bg-black rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center">
                    <div class="mb-8">
                        <img class="object-center object-cover rounded-full h-36 w-36" src="{{ asset(str_replace('assets/', '', $payment->character->img_url)) }}">
                    </div>
                    <div class="text-center">
                        <p class="text-xl text-white font-bold mb-2">{{ $payment->character->name }}</p>
                        <p class="text-base text-gray-400 font-normal">Division {{$payment->product->division  }} Level {{ $payment->product->level }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </section>

        @if($tokens->isNotEmpty())
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 py-12">
            <div class="text-center pb-12">
                <h2 class="text-base font-bold text-indigo-600">
                    GoaL
                </h2>
                <h1 class="font-bold text-3xl md:text-4xl lg:text-5xl text-white">
                    MY TOKENS
                </h1>

            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6">
                @foreach ($tokens as $token)
                <div class="w-full bg-black rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center">
                    <div class="mb-8">
                        <img class="object-center object-cover rounded-full h-36 w-36" src="{{ asset('img/logo.webp') }}">
                    </div>
                    <div class="text-center">
                        <p class="text-xl text-white font-bold mb-2">{{ optional($token)->goal_tokens }} GoaL Tokens</p>
                    </div>
                </div>

                @php
                    $_found = false;
                @endphp
                @foreach($presale as $pres)
                    @if($token->id == $pres->tokenpayment_id)
                        @include('shop.partials.followstatus')
                        @php
                            $_found = true;
                        @endphp
                    @endif
                @endforeach
                @foreach($stake as $st)
                    @if($token->id == $st->tokenpayment_id)
                        @include('shop.partials.presalestaking')
                        @php
                            $_found = true;
                        @endphp
                    @endif
                @endforeach
                @if($_found === false)
                    @include('shop.partials.presaleschoise')
                @endif
                @endforeach
            </div>
        </div>
        </section>
        @endif
    </div>
</x-app-layout>
