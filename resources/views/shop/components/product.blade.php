<div class="max-w-sm rounded overflow-hidden shadow-lg">
    <img class="w-full" src="{{ $img }}" alt="Goal Stadium Product">
    <div class="px-6 py-4" style="text-align: center;">
      <div class="font-bold text-l mb-2">{{ $priceBUSD }} BUSD</div>
      <p class="text-white text-base" style="text-align: center;">
       {{ __('web.Level') }} {{ $level }}
      </p>
    </div>
    <div class="px-6 pt-4 pb-2">
      <button onclick="startProcess({{ $price }},  {{ $level }},  {{ $division }}, {{ $id }})" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"><img src="{{ asset('img/metamask.png') }}" width="32" style="display: inline;"> {{ __('web.Purchase') }}</button>
      <button onclick="startProcessWC({{ $price }},  {{ $level }},  {{ $division }}, {{ $id }})" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"><img src="{{ asset('img/wc.png') }}" width="32" style="display: inline;"> {{ __('web.Purchase') }}</button>
    </div>
</div>
