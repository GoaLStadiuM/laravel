<x-app-layout>
    <div class="w-full bg-black">
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 py-12">
            <div class="text-center pb-12">
                <h2 class="text-base font-bold text-indigo-600">
                    {{ __('web.noappear') }}
                </h2>
                <h1 class="font-bold text-3xl md:text-4xl lg:text-5xl text-white">
                   {{ __('web.introducehash') }}
                </h1>

                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6">
                    <div class="w-full bg-black rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center">
                        <form name="manualHash" id="manualHash" method="post" action="{{ route('manualhash.check') }}">
                            @csrf
                            <div class="text-center">
                                <input type="text" name="txHash" id="txhash" class="form-control" placeholder="txHash" required>
                                <button style="padding: 8px; background-image: url('{{ asset('img/bg_btn_header.png') }}'); color:white; border: 2px solid white; border-radius: 10px; background-size: cover;">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
