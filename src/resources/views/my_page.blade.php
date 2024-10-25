@extends('layouts.app')


<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/my_page.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<main>
    @section('content')
    <div class="container">
        <div class="main_page">
            <h1 class="name">{{ Auth::user()->name }}さん</h1>
            <div class="main_contents">
                <div class="reserve_page">
                    <!-- 予約状況 -->
                    <div class="card_content">
                        <h2 class="reserve_situation">予約状況</h2>
                        <!-- 予約カード一覧 -->
                        @foreach ($reservations as $reservation)
                        <div class="card_inner">
                            <div class="flex">
                                <div class="reservation_number">予約{{ $reservation['reservation_num'] }}</div>
                                <div class='card_contents_inner'>
                                    <!-- QRコード表示 -->
                                    @if($reservation['visited_flg'] == false)
                                    <form method="GET" action="{{ url('/qr_code') }}">
                                        <input type="hidden" name="reservation_id" value="{{ $reservation['id'] }}">
                                        <button type="submit" class="qr_code_button"> </button>
                                    </form>
                                    @endif
                                    <!-- 支払いボタン -->
                                    <button type="button" class="payment_button" onclick="location.href='checkout'"></button>
                                    <!-- 変更ボタン -->
                                    <form method="GET" action="{{ url('/reserve/edit') }}">
                                        <input type="hidden" name="reservation_id" value="{{ $reservation['id'] }}">
                                        <button type="submit" class="modal-open js-open">変更</button>
                                    </form>
                                    <!-- キャンセルボタン -->
                                    <form method="POST" action="{{ url('/reserve/delete') }}">
                                        @csrf
                                        <input type="hidden" name="reservation_id" class="reservation_id" value="{{ $reservation['id'] }}">
                                        <button type="submit" class="cancel_button">×</button>
                                    </form>
                                </div>
                            </div>
                            <!-- 予約情報 -->
                            <table class="reservation_card">
                                <tr>
                                    <td class="reservation_card_index">
                                        <span>Shop</span>
                                    </td>
                                    <td class="reservation_card_inner" id="shop_name-{{$loop->index}}">
                                        <span>{{ $reservation['shop_name'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="reservation_card_index">
                                        <span>Date</span>
                                    </td>
                                    <td class="reservation_card_inner" id="reservation_date-{{$loop->index}}">
                                        <span>{{ $reservation['date'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="reservation_card_index">
                                        <span>Time</span>
                                    </td>
                                    <td class="reservation_card_inner" id="reservation_time-{{$loop->index}}">
                                        <span>{{ $reservation['time'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="reservation_card_index">
                                        <span>Number</span>
                                    </td>
                                    <td class="reservation_card_inner" id="reservation_number-{{$loop->index}}">
                                        <span>{{ $reservation['number'] }}人</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- お気に入り店舗 -->
                <div class="favorite_page">
                    <h2 class="favorite_shop">お気に入り店舗</h2>
                    <!-- お気に入りカード一覧 -->
                    <div class="favorite_situation">
                        @foreach ($favorites as $favorite)
                        <div class="favorite_page_inner">
                            <img class="image" src="{{ $favorite->shop->image_url }}">
                            <div class="shop_name">
                                <h2 class="shop_name_font">{{ $favorite->shop->name }}</h2>
                                <div class="shop_name_inner">
                                    <span>#{{ $favorite->shop->area->name }}</span>
                                    <span>#{{ $favorite->shop->genre->name}}</span>
                                </div>
                                <div class="card_contents_inner_detail">
                                    <a class="detail" href="{{ url('/detail/'.$favorite->shop->id) }}">詳しくみる</a>
                                    @if( Auth::check() )
                                    <form method="POST" action="{{ url('/favorite') }}">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                        <input type="hidden" name="shop_id" value="{{ $favorite->shop->id }}">
                                        <button class="heart"><img class="heart_image" src="{{ $favorite->shop->id ? url('../img/red_heart.jpeg') : url('../img/gray_heart.jpeg')}}"></button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</main>