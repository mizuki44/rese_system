@extends('layouts.app')

<head>
    <link rel="stylesheet" href="/css/reserve_edit.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/sanitize.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <!-- レスポンシブ対応用にmetaのviewportを記載 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<div class="modal" id="js-modal">
    <table class='reserve_content'>
        <tr class="date">
            <th class="title">店舗名</th>
            <td id="modal_shop_name" class="modal_shop_name">
                <div class="title">{{$reserve->shop->name}}</div>
            </td>
        </tr>

        <form method="POST" action="{{ url('/reserve/update') }}">
            @csrf
            <input type="hidden" name="reservation_id" value="{{$reserve->id}}">
            <tr class="date">
                <th class="title">日にち</th>
                <td>
                    <input class="date" type="date" id="date" name="date" value="{{$reserve->date}}" min="{{ $today }}" />
                </td>
            </tr>
            @error('date')
            <p class='error_message'>{{$message}}</p>
            @enderror

            <tr class="time_low">
                <th class="title">時間</th>
                <td>
                    <input type="hidden" name="selected_drop_time" value="{{$reserve->time}}">
                    <!-- <input class="drop_time" type="time" id="time" name="time" value="{{$reserve->time}}" min="{{ $today_time }}" max="20:00" step="900" /> -->
                    <input class="drop_time timepicker" id="time" name="time" value="{{$reserve->time}}" jt-timepicker="" time="model.time" time-string="model.timeString" />
                    <span class="validity"></span>
                </td>

                <!-- <div class="drop_time">
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
                </div> -->
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
            <div class="button_css">
                <button type="submit" class="change_button">変更する</button>
            </div>
        </form>
    </table>
    <script>
        var now = new Date(); // Sun Aug 04 2024 18:31:29 GMT+0900 (日本標準時)
        var yy = now.getFullYear();
        var month = now.getMonth() + 1;
        var mm = ('0' + month).slice(-2);
        var date = now.getDate();
        var dd = date = ('0' + date).slice(-2);
        var h = now.getHours();
        var i = now.getMinutes();

        $(document).ready(function() {
            console.log('init');
            $('.timepicker').timepicker({
                timeFormat: 'H:mm',
                interval: 30,
                minTime: '10',
                maxTime: '22:00',
                startTime: '10:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        });

        $('#date').blur(function() {
            var selected_date = $('#date').val(); // 2024-08-22

            if (selected_date == `${yy}-${mm}-${dd}`) {
                console.log('true');
                var minTime = `${h}:${i}`

                $('.timepicker').timepicker({
                    timeFormat: 'H:mm',
                    interval: 30,
                    minTime: minTime,
                    maxTime: '20:00',
                    startTime: '10:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
                });
            } else {
                console.log('false');
                $('.timepicker').timepicker({
                    timeFormat: 'H:mm',
                    interval: 30,
                    minTime: '10',
                    maxTime: '22:00',
                    startTime: '10:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
                });
            };
        });
    </script>
</div>