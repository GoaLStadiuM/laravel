<x-app-layout>
    <div class="bg-farming">
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 py-12">
            <div class="text-center pb-12">
                <h2 class="text-base font-bold text-indigo-600">
                    My characters
                </h2>
                <h1 class="font-bold text-3xl md:text-4xl lg:text-5xl text-white">
                    SELECT CHARACTER
                </h1>
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6">
                    @foreach($characters as $character)
                    <a href="{{ route('stats', $character->payment_id) }}">
                        <div class="w-full rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center">
                            <div class="mb-8">
                                <img class="object-center object-cover rounded-full h-36 w-36" src="{{ asset($character->base->img_url . '.webp') }}">
                            </div>
                            <div class="text-center" style="padding: 20px;background-color: rgba(59, 130, 246, 1);border: gray 2px solid;border-radius: 15px;">
                                <p class="text-xl text-white font-bold mb-2">{{ $character->base->name }}</p>
                                <p class="text-base text-gray-400 font-bold">Division {{$character->division }} Level {{ $character->level }}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
