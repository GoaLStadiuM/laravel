<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-black">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md text-white overflow-hidden sm:rounded-lg" style="background-image: url({{ asset('img/bg/bg_btn_header.webp') }}); background-size: cover;">
        {{ $slot }}
    </div>
</div>
