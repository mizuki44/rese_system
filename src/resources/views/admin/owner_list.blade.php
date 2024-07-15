@extends('layouts.app')


<head>
    <link rel="stylesheet" href="/css/sanitize.css">
</head>

<main>
    @section('content')
    <h1>店舗代表者一覧</h1>

    <form action="/admin/create" method="get">
        @csrf
    </form>
    <div class="list">
        <table class="owner_list">
            <tr class="table-title">
                <th>名前</th>
                <th>役割</th>
                <th>メールアドレス</th>
            </tr>
            @foreach($admins as $admin)
            <form action="/admin/index" method="get">
                @if(!empty($admin))
                <tr class="table-value table-value-info">
                    <td>{{$admin['name']}}</td>
                    @if($admin['role'] === 1)
                    <td>管理者</td>
                    @else
                    <td>店舗代表者</td>
                    @endif
                    <td>{{$admin['email']}}</td>
                </tr>
                @endif
            </form>
            @endforeach
        </table>
    </div>





    <button type="button" onClick="history.back()">戻る</button>
    @endsection
</main>