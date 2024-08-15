@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/shop_detail.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection



<main>
    @section('content')
    <script>
        $(function() {
            $(document).on('change', '#date', function(e) {
                $('#confirm-date').text($('#date').val());
            });
        });

        $(function() {
            $(document).on('change', '#time', function(e) {
                $('#confirm-time').text($('#time').val());
            });
        });

        $(function() {
            $(document).on('change', '#number', function(e) {
                $('#confirm-number').text($('#number').val() + '人');
            });
        });
    </script>
    <div class="detail_page">

        <!-- 店の詳細表示 -->
        <div class="shop_detail">
            <!-- 店名 -->
            <div class="shop_name">
                <button class="shop_trans" onclick="location.href='{{url('/')}}'">
                    ＜</button>
                <h1 class="shop_name3">{{ $shop['name'] }}</h1>
            </div>
            <!-- 画像 -->
            <div class="image_content">
                <img class="image_content2" src="{{ $shop['image_url'] }}">
            </div>
            <!-- 分類 -->
            <div class="classification">
                <span>#{{ $shop['area']['name'] }}</span>
                <span>#{{ $shop['genre']['name'] }}</span>
            </div>
            <!-- 説明 -->
            <div class="classification">
                <p>{{ $shop['description']}}</p>
            </div>
            <!-- 口コミ表示 -->
            @if( Auth::check() )
            @if( is_null($my_review) )
            <div class="review">
                <a href="{{ url('/review/add/'.$shop['id']) }}" class="review_button_add">口コミを投稿する</a>
            </div>
            @else
            <div class="py-5">
                <hr>
                <div class="button_flex">
                    <div class="review_button_flex">
                        <a href="{{ url('/review/edit/'.$shop['id']) }}" class="review_button">口コミを編集</a>
                    </div>
                    <div class="review_button_flex">
                        <form method="POST" action="{{ url('/review/delete') }}">
                            @csrf
                            <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <button type="submit" class="review_button">口コミを削除</button>
                        </form>
                    </div>
                </div>
                <div class="star">
                    @for ($counter = 0; $counter < 5; $counter++) <span class="{{ $counter < $my_review['star'] ? 'text-blue-600' : 'text-gray-200'}}">★</span>
                        @endfor
                </div>
                <div>
                    <p>{{$my_review['comment']}}</p>
                </div>
                <hr>
            </div>
            @endif
            @endif

        </div>

        <!-- 予約 -->
        <div class="reserve_content">
            <h1 class="reserve">予約</h1>
            <p class="reserve_text"></p>
            @if (count($errors) > 0)
            <p class='error_message'>入力に問題があります</p>
            @endif
            <form action="{{ route('reserve') }}" method="POST">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="date">
                    <input class="date" type="date" id="date" name="date" value="" min="{{ $tomorrow }}" />
                </div>
                @error('date')
                <p class='error_message'>{{$message}}</p>
                @enderror

                <!-- 時間のドロップダウン -->
                <div class="drop_time">
                    <select name="time" class="drop_time" id="time">
                        <optgroup label="lunch">
                            <option value="" selected hidden>選択してください</option>
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
                @error('time')
                <p class='error_message'>{{$message}}</p>
                @enderror
                <!-- 人数のドロップダウン -->
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
                @error('number')
                <p class='error_message'>{{$message}}</p>
                @enderror

                <button type="submit" class="reserve_button" onclick="location.href='./reserve/done' ">予約する</button>
            </form>
            <!-- 予約情報表示 -->
            <table class="reserve_confirmation">
                <tr>
                    <td class="reserve_confirmation_shop">Shop</td>
                    <td class="reserve_confirmation_item_shop">{{ $shop['name'] }}</td>
                </tr>
                <tr>
                    <td class="reserve_confirmation_title">Date</td>
                    <td id="confirm-date" class="reserve_confirmation_item"></td>
                </tr>
                <tr>
                    <td class="reserve_confirmation_title">Time</td>
                    <td id="confirm-time" class="reserve_confirmation_item"></td>
                </tr>
                <tr>
                    <td class="reserve_confirmation_number">Number</td>
                    <td id="confirm-number" class="reserve_confirmation_item_number"></td>
                </tr>
            </table>
        </div>

    </div>

    @endsection
</main>