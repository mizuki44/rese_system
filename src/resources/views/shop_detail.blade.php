@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/shop_detail.css">
<!-- <link rel="stylesheet" href="/css/app.css"> -->
<!-- <link rel="stylesheet" href="/css/sanitize.css"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- レスポンシブ対応用にmetaのviewportを記載 -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection



<main class="main">
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
    <!-- <script>
        function on_reserve_num_changed(reserve_num) {
            show_txt = reserve_num + '人';
            document.getElementById('reserve_num_trigger').innerHTML = show_txt;
            document.getElementById('reserve_num_confirm').innerHTML = show_txt;
            document.getElementById('reserve_num_input').value = reserve_num;
        }

        function on_reserve_time_changed(reserve_time) {
            document.getElementById('reserve_time_trigger').innerHTML = reserve_time;
            document.getElementById('reserve_time_confirm').innerHTML = reserve_time;
            document.getElementById('reserve_time_input').value = reserve_time;
        } <
        /script> 
        -->

    <div class="detail_page">

        <!-- 店の詳細表示 -->
        <div class="shop_detail">
            <!-- 店名 -->
            <div class="shop_name">
                <button class="shop_trans" onclick="location.href='{{url('/')}}'">
                    ＜</button> <!-- <a href="{{url('/') }}" class="shop_name2">
                        矢印</a> -->
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

            <!-- 口コミ一覧へのリンク -->
            <!-- <div class="review">
                <a href="{{ url('/review/shop_index/'.$shop['id']) }}" class="review_url">全ての口コミ情報</a>
            </div> -->

            <!-- 自身の口コミを表示 -->
            @if( Auth::check() )
            @if( is_null($my_review) )
            <div class="review">
                <a href="{{ url('/review/add/'.$shop['id']) }}" class="underline">口コミを投稿する</a>
            </div>
            @else
            <div class="py-5">
                <hr>
                <div class="flex justify-end text-sm">
                    <div class="mr-4">
                        <a href="{{ url('/review/edit/'.$shop['id']) }}" class="underline">口コミを編集</a>
                    </div>
                    <div>
                        <form method="POST" action="{{ url('/review/delete') }}">
                            @csrf
                            <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <button type="submit" class="underline">口コミを削除</button>
                        </form>
                    </div>
                </div>
                <div>
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

                <!-- 日付の選択 -->
                <!-- <form method="GET" action="{{ url('/detail/'.$shop['id']) }}" name="calender_form"> -->
                <div class="date">
                    <input class="date" type="date" id="date" name="date" value="" min="{{ $tomorrow }}" />
                </div>
                @error('date')
                <p class='error_message'>{{$message}}</p>
                @enderror
                <!-- </form> -->

                <!-- 時間のドロップダウン -->
                <!-- <form action="/reserve" method="POST"> -->
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
            <!-- <div>{{ $shop['name'] }}</div>
            <div id="confirm-date"></div>
            <div id="confirm-time"></div>
            <div id="confirm-number"></div> -->

            <!-- <div class="time_dropdown  flex items-center mt-3">
                <div class="" align="left" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center bg-white rounded hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div class="w-48 text-left py-1 px-3">
                                <span id="reserve_time_trigger">{{ empty($time_array) ? "定休日" : $time_array[0] }}</span>
                            </div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                </div> -->

            <!-- 人数のドロップダウン -->
            <!-- <div class="flex items-center mt-3">
                    <div class="align= left" width="48"> -->
            <!-- x-dropdown -->
            <!-- <x-slot name="trigger">
                            <button class="flex items-center bg-white rounded hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div class="w-48 text-left py-1 px-3">
                                    <span id="reserve_num_trigger">{{ empty($num_array) ? "予約できません" : $num_array[0] . '人' }}</span>
                                </div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                    </div> -->

            <!-- 予約内容の表示 -->
            <!-- <div class="max-md:hidden bg-blue-500 rounded mt-4 p-4">
                    <table class="text-white">
                        <tr>
                            <td>
                                <span>店名</span>
                            </td>
                            <td class="pl-8">
                                <span>{{ $shop['name'] }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>日付</span>
                            </td>
                            <td class="pl-8">
                                <span id="reserve_date_confirm">{{ $reserve_date }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>時刻</span>
                            </td>
                            <td class="pl-8">
                                <span id="reserve_time_confirm">{{ empty($time_array) ? '' : $time_array[0] }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>人数</span>
                            </td>
                            <td class="pl-8">
                                <span id="reserve_num_confirm">{{ empty($num_array) ? '' : $num_array[0] . '人' }}</span>
                            </td>
                        </tr>
                    </table>
                </div> -->


        </div>

    </div>

    @endsection
</main>