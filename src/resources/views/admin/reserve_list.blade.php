@extends('layouts.app')


<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/admin_reserve_list.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<main>
    @section('content')
    <h1 class="title">予約情報一覧</h1>
    <form action="/admin/create" method="get">
        @csrf
    </form>


    <div class="list">
        <table class="reserve_list">
            <tr class="table-low">
                <th class="table-title_inner">予約者氏名</th>
                <th class="table-title_inner">店舗名</th>
                <th class="table-title_inner">日付</th>
                <th class="table-title_inner">時間</th>
                <th class="table-title_inner">人数</th>
            </tr>
            @foreach($reservations as $reservation)
            <form action="/admin/reserve" method="get">
                @if(!empty($reservation))
                <tr class="table-low">
                    <td class="table-inner">{{$reservation->user->name}}</td>
                    <td class="table-inner">{{$reservation->shop->name}}</td>
                    <td class="table-inner">{{$reservation->date}}</td>
                    <td class="table-inner">{{$reservation->time}}</td>
                    <td class="table-inner">{{$reservation->number}}</td>

                    <!-- 変更ボタン -->
                    <!-- <td> <input type="hidden" name="reservation_id" id="reservation_for_update" value="{{ $reservation['id'] }}">
                        <button class="modal-open js-open" value="{{$loop->index}}">変更</button>
                    </td> -->
                    <!-- キャンセルボタン -->
                    <!-- <td>
                        <form method="POST" action="{{ url('admin/owner/delete') }}">
                            @csrf
                            <input type="hidden" name="reservation_id" class="reservation_id" value="{{ $reservation['id'] }}">
                            <button type="submit" class="cancel_button">削除</button>
                        </form>
                    </td>
                </tr> -->
                    @endif
            </form>
            @endforeach
        </table>
    </div>

    <!-- モーダル開始 -->
    <!-- <div class="overlay" id="js-overlay"></div>
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

            <form method="POST" action="{{ url('admin/owner/update') }}">
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
            <form method="POST" action="{{ url('/admin/reserve/update') }}">
                @csrf
                <input type="hidden" name="reservation_id" class="reservation_for_modal" value="">
                <button type="submit" class=" change_button">変更する</button>
            </form>
        </div>
        </form>
    </div> -->
    <!-- モーダル終了 -->


    <a class="return" href="{{ route('admin.index') }}">戻る</a>
    @endsection
</main>