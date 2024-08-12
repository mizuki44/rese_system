<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/admin_reserve_list.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<main>
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
                    <td class="table-inner" data-label="予約者氏名">{{$reservation->user->name}}</td>
                    <td class="table-inner" data-label="店舗名">{{$reservation->shop->name}}</td>
                    <td class="table-inner" data-label="日付">{{$reservation->date}}</td>
                    <td class="table-inner" data-label="時間">{{$reservation->time}}</td>
                    <td class="table-inner" data-label="人数">{{$reservation->number}}</td>
                    @endif
            </form>
            @endforeach
        </table>
    </div>

    <a class="return" href="{{ route('admin.index') }}">戻る</a>
</main>