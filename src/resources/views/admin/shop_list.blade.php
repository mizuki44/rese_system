@extends('layouts.app')


<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<main>
    @section('content')
    <h1>店舗一覧</h1>

    <form method="GET" action="{{ url('/admin/shop/create') }}">
        @csrf
        <button type="submit" class="shop_create_button">新規登録</button>
    </form>

    <div class="list">
        <table class="owner_list">
            <tr class="table-title">
                <th>店舗名</th>
                <th>エリア</th>
                <th>ジャンル</th>
                <th>説明</th>
                <th>イメージ</th>
            </tr>
            @foreach($shops as $shop)

            @if(!empty($shop))
            <tr class="table-value table-value-info">
                <td>{{$shop['name']}}</td>
                <td>{{$shop->area->name}}</td>
                <td>{{$shop->genre->name}}</td>
                <td>{{$shop['description']}}</td>
                <td>{{$shop['image_url']}}</td>
                <!-- 変更ボタン -->
                <td>
                    <form method="GET" action="{{url('/admin/shop/edit')}}">
                        @csrf
                        <input type="hidden" name="shop_id" id="shop_id" value="{{ $shop['id'] }}">
                        <button type="submit" class="edit_button">変更</button>
                    </form>
                </td>
                <!-- キャンセルボタン -->
                <td>
                    <form method="POST" action="{{url('/admin/shop/delete')}}">
                        @csrf
                        <input type="hidden" name="shop_id" class="shop_id" value="{{ $shop['id'] }}">
                        <button type="submit" class="delete_button">削除</button>
                    </form>
                </td>
            </tr>
            @endif

            @endforeach
        </table>
    </div>

    <button type="button" onClick="history.back()">戻る</button>
    @endsection
</main>