@extends('layouts.default')


<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/shop_detail.css">
</head>

<!-- @section('title', '打刻ページ')
@section('content') -->


<main>

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
            }
        </script> -->

    <div class="detail_page">

        <!-- 店の詳細表示 -->
        <div class="shop_detail">
            <!-- 店名 -->
            <div class="shop_name">
                <a class="shop_name2" href="{{url('/') }}">
                </a>
                <h1 class="shop_name3" pl-2 font-bold text-2xl">{{ $shop['name'] }}</h1>
            </div>

            <!-- 画像 -->
            <div class="image_content">
                <img class="image_content2" src="{{ $shop['image_url'] }}">
            </div>

            <!-- 分類 -->
            <div class="pt-5">
                <span>#{{ $shop['area']['name'] }}</span>
                <span>#{{ $shop['genre']['name'] }}</span>
            </div>

            <!-- 説明 -->
            <div class="classification">
                <p>{{ $shop['description']}}</p>
            </div>

            <!-- 口コミ一覧へのリンク -->
            <div class="review">
                <a href="{{ url('/review/shop_index/'.$shop['id']) }}" class="review_url">全ての口コミ情報</a>
            </div>

            <!-- 自身の口コミを表示 -->
            <!-- @if( Auth::check() )
                @if( is_null($my_review) )
                <div class="py-5">
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
                    <div class="w-56">
                        @if (!is_null($my_review['image_url']))
                        <img src="{{ $my_review['image_url'] }}">
                        @endif
                    </div>
                    <hr>
                </div>
                @endif
                @endif -->

        </div>

        <!-- 予約 -->
        <div class="reserve_content">
            <h1 class="reserve">予約</h1>
            <p class="reserve_text"></p>
            <!-- 日付の選択 -->
            <form method="GET" action="{{ url('/detail/'.$shop['id']) }}" name="calender_form">
                @csrf
                <input class="date" type="date" id="date" name="date" value="{{ $reserve_date }}" min="{{ $tomorrow }}" onchange="document.calender_form.submit()" />
            </form>

            <!-- 時間のドロップダウン -->
            <form action="/reserve" method="POST">
                <select name="drop_time">
                    <optgroup label="lunch">
                        <option value="1">11:00</option>
                        <option value="2">11:30</option>
                        <option value="3">12:00</option>
                        <option value="4">12:30</option>
                        <option value="5">13:00</option>
                    </optgroup>
                    <optgroup label="dinner">
                        <option value="6">18:00</option>
                        <option value="7">18:30</option>
                        <option value="8">19:00</option>
                        <option value="9">19:30</option>
                        <option value="10">20:00</option>
                    </optgroup>
            </form>
            </select>
            <select name="drop_number">
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
            </form>

            <div class="time_dropdown  flex items-center mt-3">
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

                </div>

                <!-- 人数のドロップダウン -->
                <div class="flex items-center mt-3">
                    <div class="align= left" width="48">
                        <!-- x-dropdown -->
                        <x-slot name="trigger">
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

                    </div>

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

                    <form method="POST" action="{{ url('/reserve') }}">
                        @csrf
                        <input type="hidden" id="reserve_shop_input" name="shop_id" value="{{ $shop['id'] }}">
                        <input type="hidden" id="reserve_date_input" name="date" value="{{ $reserve_date }}">
                        <input type="hidden" id="reserve_time_input" name="start_time" value="{{ empty($time_array) ? '' : $time_array[0] }}">
                        <!-- $time_arrayは作る -->
                        <input type="hidden" id="reserve_num_input" name="number_of_people" value="{{ empty($num_array) ? '' : $num_array[0] }}">
                        <!-- $num_arrayは作る -->

                        <!-- <input type="hidden" id="reserve_length" name="time_per_reservation" value="{{ $shop['time_per_reservation'] }}"> -->
                        <div class="text-red-600">
                            @error('shop_id')
                            ※{{ $message }} <BR>
                            @enderror
                            @error('date')
                            ※{{ $message }} <BR>
                            @enderror
                            @error('start_time')
                            ※{{ $message }} <BR>
                            @enderror
                            @error('number_of_people')
                            ※{{ $message }} <BR>
                            @enderror
                            @error('time_per_reservation')
                            ※{{ $message }} <BR>
                            @enderror
                        </div>
                        <button type="submit" class="bg-blue-700 text-white disabled:text-blue-500 w-full py-4 rounded-b absolute bottom-0 left-0" {{ empty($time_array) ? 'disabled' : '' }}>予約する</button>
                    </form>

                </div>

            </div>



</main>