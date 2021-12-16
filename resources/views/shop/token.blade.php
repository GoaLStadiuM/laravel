<x-app-layout>
    <div class="py-12" style="margin-top: 50px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-black text-white" style="width: 100%; background-image: url({{ asset('img/bg_btn_header.png') }}); background-size: cover;">
                   <h3 style="font-size: 24px; font-weight: 700;">{{ __('web.Token') . ' Packs'}}</h3>
                </div>

                <div class="col-3 md:col-6 sm:col-12 text-white" style="margin-top: 3rem;">
                @foreach ($products as $product)
                    <div class="max-w-sm rounded overflow-hidden shadow-lg mx-auto">
                        <img class="mx-auto" src="{{ asset('img/logo.webp') }}" alt="Goal Stadium Product">
                        <div class="px-6 py-4" style="text-align: center;">
                            <div class="font-bold text-l mb-2"><input style="color: black; width: 30%;" type="number" min="1" max="500" id="price" oninput="updateGoal(this.value)" value="{{ $product->price }}"> BUSD</div>
                            <input type="hidden" id="goal-value" value="{{ $product->price }}">
                            <p class="text-white text-base" style="text-align: center;">
                                GoaL Tokens: <span id="goal">{{ $product->goal_amount }}</span>
                            </p>
                        </div>
                        <div class="px-6 pt-4 pb-2" style="text-align: center;">
                            <button onclick="startProcess(document.getElementById('price').value, {{ $product->id }}, document.getElementById('goal').innerHTML)" class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700"><img src="{{ asset('img/metamask.png') }}" width="32" style="display: inline;"> {{ __('web.Purchase') }}</button>
                            <button onclick="startProcessWC(document.getElementById('price').value, {{ $product->id }}, document.getElementById('goal').innerHTML)" class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700"><img src="{{ asset('img/wc.png') }}" width="32" style="display: inline;"> {{ __('web.Purchase') }}</button>
                        </div>
                    </div>
                @endforeach
                </div>
                <script>
                    function updateGoal(val) {
                        const price = document.getElementById('price');
                        if (val < 1 || val > 500)
                        {
                            price.style.borderColor = 'red';
                            return;
                        }
                        price.style.borderColor = 'none';
                        document.getElementById('goal').textContent = val / document.getElementById('goal-value').value;
                    }
                </script>
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

<script src="{{ asset('js/tokenmetamaskconnector.js') }}"></script>
<script src="{{ asset('js/tokenwalletconnectconnector.js') }}"></script>
