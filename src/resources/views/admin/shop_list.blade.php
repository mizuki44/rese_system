<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/admin_shop_list.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<main>
    <h1 class="title">店舗一覧</h1>

    <form method="GET" action="{{ url('/admin/shop/create') }}">
        @csrf
        <button type="submit" class="button">新規登録</button>
    </form>

    <div class="list">
        <table class="shop_list">
            <tr class="table-low">
                <th class="table-title_inner">店舗名</th>
                <th class="table-title_inner">エリア</th>
                <th class="table-title_inner">ジャンル</th>
                <th class="table-title_inner">説明</th>
                <th class="table-title_inner">イメージ</th>
                <th class="table-title_inner">変更・削除</th>
            </tr>
            @foreach($shops as $shop)

            @if(!empty($shop))
            <tr class="table-low">
                <td class="table-inner">{{$shop['name']}}</td>
                <td class="table-inner">{{$shop->area->name}}</td>
                <td class="table-inner">{{$shop->genre->name}}</td>
                <td class="table-inner">{{$shop['description']}}</td>
                <td class="table-inner"><img class="image" src="{{ $shop->image_url }}" /></td>
                <!-- 変更ボタン -->
                <td class="table-inner">
                    <div class="button_layout">
                        <form method="GET" action="{{url('/admin/shop/edit')}}">
                            @csrf
                            <input type="hidden" name="shop_id" id="shop_id" value="{{ $shop['id'] }}">
                            <button type="submit" class="button">変更</button>
                        </form>
                        <!-- キャンセルボタン -->
                        <form method="POST" action="{{url('/admin/shop/delete')}}">
                            @csrf
                            <input type="hidden" name="shop_id" class="shop_id" value="{{ $shop['id'] }}">
                            <button type="submit" class="button">削除</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endif

            @endforeach
        </table>
    </div>

    <a class="return" href="{{ route('admin.index') }}">戻る</a>
</main>