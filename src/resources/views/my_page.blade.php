@extends('layouts.app')


<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/my_page.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<main>
    @section('content')
    <div class="main_page">
        <h1 class="name">{{ Auth::user()->name }}さん</h1>
        <div class="main_contents">
            <div class="reserve_page">
                <!-- 予約状況 -->
                <div class="card_contents_inner_1">
                    <h2 class="reserve_situation">予約状況</h2>
                    <!-- 予約カード一覧 -->
                    <div>
                        @foreach ($reservations as $reservation)
                        <div class="card_contents_inner_2 w-4/5 h-48 bg-blue-600 text-white rounded-md shadow-md mb-4 px-3 py-3 relative">
                            <div class="flex justify-between">
                                <h3 class="reservation_number">予約{{ $reservation['reservation_num'] }}</h3>
                                <div class='card_contents_inner_3'>
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
                                    <input type="hidden" name="reservation_id" id="reservation_for_update" value="{{ $reservation['id'] }}">
                                    <button class="modal-open js-open" value="{{$loop->index}}">変更</button>
                                    <!-- キャンセルボタン -->
                                    <form method="POST" action="{{ url('/reserve/delete') }}">
                                        @csrf
                                        <input type="hidden" name="reservation_id" class="reservation_id" value="{{ $reservation['id'] }}">
                                        <button type="submit" class="cancel_button">×</button>
                                    </form>
                                </div>
                            </div>

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
                                        <span>date</span>
                                    </td>
                                    <td class="reservation_card_inner" id="reservation_date-{{$loop->index}}">
                                        <span>{{ $reservation['date'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="reservation_card_index">
                                        <span>time</span>
                                    </td>
                                    <td class="reservation_card_inner" id="reservation_time-{{$loop->index}}">
                                        <span>{{ $reservation['time'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="reservation_card_index">
                                        <span>number</span>
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

                <!-- モーダル開始 -->
                <div class="overlay" id="js-overlay"></div>
                <div class="modal" id="js-modal">
                    <div class="modal-close__wrap">
                        <button class="modal-close js-close" id="js-close">
                            <sp>×</sp>
                        </button>
                    </div>
                    <table class='reserve_content'>
                        <input type="hidden" name="reservation_id" value="">
                        <tr class="date">
                            <th class="title">店舗名</th>
                            <td id="modal_shop_name" class="modal_shop_name">
                                <div class="title">shop_name</div>
                            </td>
                        </tr>

                        <form method="POST" action="{{ url('/reserve/update') }}">
                            @csrf
                            <input type="hidden" name="reservation_id" class="reservation_for_modal" value="">
                            <tr class="date">
                                <th class="title">日にち</th>
                                <td>
                                    <input class="date" type="date" id="date" name="date" value="" min="{{ $tomorrow }}" />
                                </td>
                            </tr>
                            @error('date')
                            <p class='error_message'>{{$message}}</p>
                            @enderror

                            <tr class="time_low">
                                <th class="title">時間</th>
                                <td>
                                    <div class="drop_time">
                                        <select name="time" class="drop_time" id="time">
                                            <option value="" selected hidden>選択してください</option>
                                            <optgroup label="lunch">
                                                <option value="11:00:00">11:00</option>
                                                <option value="11:30:00">11:30</option>
                                                <option value="12:00:00">12:00</option>
                                                <option value="12:30:00">12:30</option>
                                                <option value="13:00:00">13:00</option>
                                            </optgroup>
                                            <optgroup label="dinner">
                                                <option value="18:00:00">18:00</option>
                                                <option value="18:30:00">18:30</option>
                                                <option value="19:00:00">19:00</option>
                                                <option value="19:30:00">19:30</option>
                                                <option value="20:00:00">20:00</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </td>
                                @error('time')
                                <p class='error_message'>{{$message}}</p>
                                @enderror
                            </tr>
                            <tr class="number_low">
                                <th class="title">人数</th>
                                <td>
                                    <div class="drop_number">
                                        <select name="number" class="drop_number" id="number">
                                            <option value="" selected hidden>選択してください</option>
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
                                </td>
                                @error('number')
                                <p class='error_message'>{{$message}}</p>
                                @enderror
                            </tr>
                    </table>
                    <div class="button_css">
                        <form method="POST" action="{{ url('/reserve/update') }}">
                            @csrf
                            <input type="hidden" name="reservation_id" class="reservation_for_modal" value="">
                            <button type="submit" class=" change_button">変更する</button>
                        </form>

                        <!-- <form method="POST" action="{{ url('/reserve/delete') }}">
                                    @csrf
                                    <input type="hidden" name="reservation_id" class="reservation_for_modal" value="">
                                    <button type="submit" class="cancel_button">キャンセルする</button>
                                </form> -->
                    </div>
                    </form>
                    </た>
                </div>
                <!-- モーダル終了 -->

                <!-- お気に入り店舗 -->
                <div class="favorite_page">
                    <h2 class="favorite_shop">お気に入り店舗</h2>
                    <!-- お気に入りカード一覧 -->
                    <div class="favorite_situation">
                        @foreach ($favorites as $favorite)
                        <div class="favorite_page_inner">
                            <div><img class="image" src="{{ $favorite->shop->image_url }}"></div>
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
            </div> <!-- main_contents -->
        </div> <!-- main_page -->
        @endsection
        <script>
            $(function() {
                $(".js-open").click(function() {
                    $("#js-modal").addClass("open"); // modalクラスにopenクラス付与
                    $("#js-overlay").addClass("open"); // overlayクラスにopenクラス付与

                    var modal = $(this)
                    var index = $(this).val();
                    var shop_name = $(`#shop_name-${index}`).text();
                    var date = $(`#reservation_date-${index}`).text().trim();
                    var time = $(`#reservation_time-${index}`).text().trim();
                    var number = $(`#reservation_number-${index}`).text().trim().replace('人', '');

                    var reservation_id = $("#reservation_for_update").val();
                    $('#date').attr('value', date);
                    $('.reservation_for_modal').attr('value', reservation_id);
                    $(`#time option[value='${time}']`).prop('selected', true);
                    $(`#number option[value='${number}']`).prop('selected', true);
                    $('#modal_shop_name').text(shop_name)
                })
            });

            $(function() {
                $(".js-close").click(function() {
                    $("#js-modal").removeClass("open"); // overlayクラスからopenクラスを外す
                    $("#js-overlay").removeClass("open"); // overlayクラスからopenクラスを外す
                })
            });
        </script>
</main>