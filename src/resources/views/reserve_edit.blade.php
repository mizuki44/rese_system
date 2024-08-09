

<head>
    <link rel="stylesheet" href="/css/reserve_edit.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <!-- レスポンシブ対応用にmetaのviewportを記載 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<main>
    <div class="content">
        <form method="POST" action="{{ url('/reserve/update') }}">
            @csrf
            <table class='contact-table'>
                <tr class="">
                    <th class="contact-item">店舗名</th>
                    <td id="modal_shop_name" class="contact-body">
                        <div class="title">{{$reserve->shop->name}}</div>
                    </td>
                </tr>
                <input type="hidden" name="reservation_id" value="{{$reserve->id}}">
                <tr class="">
                    <th class="contact-item">日にち</th>
                    <td class="contact-body">
                        <input class="date" type="date" id="date" name="date" value="{{$reserve->date}}" min="{{ $today }}" />
                        @error('date')
                        <p class='error_message'>{{$message}}</p>
                        @enderror
                    </td>
                </tr>


                <tr class="">
                    <th class="contact-item">時間</th>
                    <td class="contact-body">
                        <input type="hidden" name="selected_drop_time" value="{{$reserve->time}}" />
                        <input class="drop_time timepicker" id="TimePicker" name="time" value="{{$reserve->time}}" autocomplete="off" />
                        @error('time')
                        <p class='error_message'>{{$message}}</p>
                        @enderror
                    </td>
                </tr>
                <tr class="number_low">
                    <th class="contact-item">人数</th>
                    <td class="contact-body">
                        <div class="drop_number">
                            <select name="number" class="form-select" id="number">
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
                    </td>
                </tr>
            </table>
            <div class="button_css">
                <button type="submit" class="contact-submit">変更する</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            var now = new Date(); // Sun Aug 04 2024 18:31:29 GMT+0900 (日本標準時)
            var yy = now.getFullYear();
            var month = now.getMonth() + 1;
            var mm = ('0' + month).slice(-2);
            var date = now.getDate();
            var dd = date = ('0' + date).slice(-2);
            var h = now.setTime(now.getHours() + 1);

            $('.timepicker').timepicker({
                timeFormat: 'H:mm',
                interval: 30,
                minTime: '10:00',
                maxTime: '21:00',
                startTime: '10:00',
                dynamic: false,
                dropdown: true,
                scrollbar: false
            });

            $('#date').blur(function() {
                var selected_date = $('#date').val(); // 2024-08-22
                $('.drop_time').val('');

                if (selected_date == `${yy}-${mm}-${dd}`) {
                    var minTime = `${h}:00`
                    console.log(minTime);
                    if (minTime == '24') {
                        $('.timepicker').data('TimePicker').options.minTime = minTime;
                        $('.timepicker').data('TimePicker').options.dropdown = true;
                        $('.timepicker').data('TimePicker').items = null;
                        $('.timepicker').data('TimePicker').widget.instance = null;
                    } else {
                        $('.timepicker').data('TimePicker').options.dropdown = false;
                        $('.timepicker').data('TimePicker').items = null;
                        $('.timepicker').data('TimePicker').widget.instance = null;
                    }
                } else {
                    $('.timepicker').data('TimePicker').options.minTime = '10:00';
                    $('.timepicker').data('TimePicker').options.dropdown = true;
                    $('.timepicker').data('TimePicker').items = null;
                    $('.timepicker').data('TimePicker').widget.instance = null;
                };
            });
        });
    </script>
</main>