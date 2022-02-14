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
                    <h3><img src="{{ asset('img/strong.png') }}" width="64" class="icon-farming"></img> {{ $character->strength }} <img src="{{ asset('img/accuracy.png') }}" class="icon-farming" width="64"></img> {{ $character->accuracy }}</h3>
                </div>
                <section class="max-w-6xl mx-auto py-12 farming-btns">
                    @foreach ($sessions as $session)
                    <a class="farming-btn" href="{{ route('selectTraining', ['payment_id' => $character->payment_id, 'session_id' => $session->id]) }}">{{ $session->name }}</a>
                    @endforeach
                </section>
            </aside>
        </section>
    </div>
</x-app-layout>
