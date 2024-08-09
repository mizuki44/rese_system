<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/qr_cord.css') }}">
</head>

<body>
    <main>
        <div class="content">
            <h1>店員へ提示してください</h1>
            <div class="qr_cord">
                {!! QrCode::size(300)->generate(route('reserve.qr_code_update',['reservation_id' => $reservation_id])); !!}
            </div>
            <div>
                <a class="back" href="{{ url('/my_page') }}">戻る</a>
            </div>
        </div>
    </main>
</body>
