<section class="max-w-6xl mx-auto py-12 farming-btns">
    @foreach ($trainingTypes as $name => $type)
    <a class="farming-btn" href="{{ route('selectTraining', ['player_id' => $player->id , 'training_type' => $type, 'payment_id' => $payment->id]) }}">{{ $name }}</a>
    @endforeach
</section>
