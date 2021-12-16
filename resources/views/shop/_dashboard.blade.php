<x-app-layout>
    <div class="py-12" style="margin-top: 50px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black overflow-hidden shadow-sm sm:rounded-lg">
            @foreach ($products as $division => $items)
                <div class="p-6 bg-black text-white" style="width: 100%; background-image: url({{ asset('img/bg_btn_header.png') }}); background-size: cover;">
                   <h3 style="font-size: 24px; font-weight: 700;">{{ __('web.Division') . ' ' . $division }}</h3>
                </div>

                <div class="p-6 grid grid-cols-3 gap-4 md:grid-cols-6 sm:grid-cols-12 text-white">
                @foreach ($items as $product)
                    @component('shop.components.product')
                        @slot('id') {{ optional($product)->id }} @endslot
                        @slot('img') {{ asset('img/numbers/' . optional($product)->level . '.png') }} @endslot
                        @slot('name') {{ optional($product)->name }} @endslot
                        @slot('level') {{ optional($product)->level }} @endslot
                        @slot('division') {{ optional($product)->division }} @endslot
                        @slot('price') {{ optional($product)->price }} @endslot
                        @slot('priceBUSD') {{ optional($product)->price }} @endslot
                    @endcomponent
                @endforeach
                </div>
            @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
  <script src="https://unpkg.com/moralis/dist/moralis.js"></script>
  <script src="https://github.com/WalletConnect/walletconnect-monorepo/releases/download/1.6.2/web3-provider.min.js"></script>

<script src="{{ asset('js/metamaskconnector.js') }}"></script>
<script src="{{ asset('js/walletconnectconnector.js') }}"></script>
