@extends('layouts.app')


<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/my_page.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<main>
    @section('content')
    <div class="main max-w-7xl mx-auto px-4 lg:px-8">
        <h1 class="name">{{ Auth::user()->name }}さん</h1>

        <div class="reserve_page">
            <!-- 予約状況 -->
            <div class="md:w-5/12">
                <h2 class="reserve_situation">予約状況</h2>
                <!-- 予約カード一覧 -->
                <div class="card_contents_inner_1">
                    @foreach ($reservations as $reservation)
                    <div class="w-4/5 h-48 bg-blue-600 text-white rounded-md shadow-md mb-4 px-3 py-3 relative">
                        <div class="flex justify-between">
                            <h3 class="reservation_number">予約{{ $reservation['reservation_num'] }}</h3>
                            <!-- QRコード表示 -->
                            <!-- <form method="GET" action="{{ url('/qr_code') }}">
                                    <input type="hidden" name="reservation_id" value="{{ $reservation['id'] }}">
                                    <button type="submit" class="text-sm text-white bg-blue-600 border-solid border border-white hover:bg-gray-200 rounded w-16">QRコード</button>
                                </form> -->
                        </div>
                        <table class="reservation_card">
                            <tr>
                                <td class="reservation_card_index">
                                    <span>Shop</span>
                                </td>
                                <td class="reservation_card_inner">
                                    <span>{{ $reservation['shop_name'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="reservation_card_index">
                                    <span>date</span>
                                </td>
                                <td class="reservation_card_inner">
                                    <span>{{ $reservation['date'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="reservation_card_index">
                                    <span>time</span>
                                </td>
                                <td class="reservation_card_inner">
                                    <span>{{ $reservation['time'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="reservation_card_index">
                                    <span>number</span>
                                </td>
                                <td class="reservation_card_inner">
                                    <span>{{ $reservation['number'] }}人</span>
                                </td>
                            </tr>
                        </table>
                        <form method="GET" action="{{ url('/reserve/edit') }}">
                            <input type="hidden" name="reservation_id" value="{{ $reservation['id'] }}">

                            <a class="modal-open js-open" id="js-open">変更</a>
                            <!-- <a class="admin__detail-btn" href="#{{ $reservation['id'] }}">変更</a> -->
                        </form>
                        <!-- モーダル開始 -->
                        <div class="overlay" id="js-overlay"></div>
                        <div class="modal" id="js-modal">

                            <div>{{ $reservation['shop_name'] }}</div>
                            <div class="modal-close__wrap">
                                <button class="modal-close js-close" id=" js-close">
                                    <span>×</span>
                                </button>
                            </div>
                            <form method="GET" action="{{ url('/reserve/edit') }}">
                                <input type="hidden" name="reservation_id" value="{{ $reservation['id'] }}">
                                <div class="date">
                                    <input class="date" type="date" id="date" name="date" value="{{ $reservation['date'] }}" />
                                </div>
                                <div class="drop_time">
                                    <select name="drop_time" class="drop_time" id="time">
                                        <optgroup label="lunch">
                                            <option value="11:00">11:00</option>
                                            <option value="11:30">11:30</option>
                                            <option value="12:00">12:00</option>
                                            <option value="12:30">12:30</option>
                                            <option value="13:00">13:00</option>
                                        </optgroup>
                                        <optgroup label="dinner">
                                            <option value="18:00">18:00</option>
                                            <option value="18:30">18:30</option>
                                            <option value="19:00">19:00</option>
                                            <option value="19:30">19:30</option>
                                            <option value="20:00">20:00</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="drop_number">
                                    <select name="drop_number" class="drop_number" id="number">
                                        <option value="1">1人</option>
                                        <option value="2">2人</option>
                                        <option value="3">3人</option>
                                        <option value="4">4人</option>
                                        <option value="5">5人</option>
                                        <option value="6">6人</option>
                                        <option value="7">7人</option>
                                        <option value="8">8人</option>
                                        <option value="9">9人</option>
                                        <option value="10">10人</option>
                                    </select>
                                </div>

                                <button type="submit" class="reserve_button" onclick="location.href='./reserve/done' ">変更する</button>
                            </form>
                        </div>
                        <!-- モーダル終了 -->

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
                        <div>
                            <img class="image" src="{{ $favorite->shop->image_url }}">
                        </div>
                        <div class="shop_name">
                            <h2 class="shop_name1">{{ $favorite->shop->name }}</h2>
                            <div class="shop_name2">
                                <span>#{{ $favorite->shop->area->name }}</span>
                                <span>#{{ $favorite->shop->genre->name}}</span>
                            </div>
                            <div class="card_contents_inner_2">
                                <a class="detail" href="{{ url('/detail/'.$favorite->shop->id) }}">詳しくみる</a>
                                @if( Auth::check() )
                                <form method="POST" action="{{ url('/favorite') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                    <input type="hidden" name="shop_id" value="{{ $favorite->shop->id }}">
                                    <button class="favorite_button {{ $favorite->shop ? 'color_red' : 'color_gray' }}" type="submit">&#9829;</button>
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
    @endsection
    <script>
        $(function() {
            $(".js-open").click(function() {
                console.log('open');
                $("#js-modal").addClass("open"); // modalクラスにopenクラス付与
                $("#js-overlay").addClass("open"); // overlayクラスにopenクラス付与
            })
        });

        $(function() {
            $(".js-close").click(function() {
                console.log('close');
                $("#js-modal").removeClass("open"); // overlayクラスからopenクラスを外す
                $("#js-overlay").removeClass("open"); // overlayクラスからopenクラスを外す
            })
        });
    </script>
</main>