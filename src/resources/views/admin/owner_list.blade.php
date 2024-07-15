@extends('layouts.app')


<head>
    <link rel="stylesheet" href="/css/sanitize.css">
</head>

<main>
    @section('content')
    <form method="GET" action="{{ url('/admin/owner/create') }}">
        @csrf
        <button type="submit" class="owner_create_button">新規登録</button>
    </form>
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





    <a class="rounded-md bg-gray-800 text-white px-4 py-2" href="{{ route('admin.index') }}">戻る</a>
    @endsection
</main>