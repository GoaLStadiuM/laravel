<x-app-layout>
    <div class="bg-farming">
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 py-12">
            <div class="text-center pb-12">
                <h1 class="font-bold text-3xl md:text-4xl lg:text-5xl text-white">
                    SELECT TRAINING
                </h1>
            </div>
            <aside class="sci-panel">
                <div class="stats">
                    <h3><img src="{{ asset('img/strong.png') }}" width="64" class="icon-farming"></img> {{ $player->strengh }} <img src="{{ asset('img/accuracy.png') }}" class="icon-farming" width="64"></img> {{ $player->accuracy }}</h3>
                </div>
                @include('farming.partials.selecttraining')
            </aside>
        </section>
    </div>
</x-app-layout>
