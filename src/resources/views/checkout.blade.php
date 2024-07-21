<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stripe Checkout</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
</head>

<body>
    <div class="container" id="checkout">
        <form action="{{ route('checkout.session') }}" method="POST" id="stripe-form">
            @csrf
            <div class="drop_course">
                <select name="course_name" class="course_name" id="course_name">
                    <option value="" selected hidden>選択してください</option>
                    <option value="1">松（5000円）</option>
                    <option value="2">竹（7000円）</option>
                    <option value="3">梅（10000円）</option>
                </select><br>
                @error('course_name')
                <p class='error_message'>{{$message}}</p>
                @enderror
                <button type="submit" id="card-button" class="btn btn-primary mt-5">
                    購入画面へ
                </button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>