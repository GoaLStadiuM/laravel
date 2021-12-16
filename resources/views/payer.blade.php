<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GoaL</title>
</head>
<body>
    @foreach($elms as $elm)
        <button onclick="sendPresale('{{ $elm->wallet }}', '{{ $elm->amount }}', {{ $elm->id }})">Pay to</button><span>{{ $elm->wallet }}</span>
        <br>
    @endforeach
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.6.1/web3.min.js" integrity="sha512-5erpERW8MxcHDF7Xea9eBQPiRtxbse70pFcaHJuOhdEBQeAxGQjUwgJbuBDWve+xP/u5IoJbKjyJk50qCnMD7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
    <script src="{{ asset('js/goalconnector.js') }}"></script>
</body>
</html>
