<!DOCTYPE html>
<html lang="ja">




<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/review_shop_index.css') }}">
    @yield('css')
</head>



<div class="max-w-7xl mx-auto px-4 lg:px-8 divide-y-2">
    <div class="my-6">
        <h1 class="text-2xl">{{ $shop['name'] }}の口コミ</h1>
        <a class="underline text-sm" href="{{ url('/detail/'.$shop['id']) }}">店舗詳細へ</a>
    </div>
    <div class="divide-y-2">
        @foreach($reviews as $review)
        <div class="py-2">
            <div>
                {{dd($review)}}
                @for($counter = 0; $counter < 5; $counter++) <span class="{{ $counter < $review['star'] ? 'text-blue-600' : 'text-gray-200'}}">★</span>
                    @endfor
            </div>
            <div>
                ああああ{{ $review['comment'] }}
            </div>
            <div class="w-56">
                @if(!is_null($review['image_url']))
                <img src="{{ $review['image_url'] }}">
                @endif
            </div>
        </div>
        @endforeach
    </div>

</div>