@extends('layouts.app')


<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/admin_index.css">
</head>

<main>
    @section('content')
    <h1 class='title'>管理画面</h1>
    <div class="body">


        <ul class='list'>
            @can ('admin_only')
            <li class='list_content'><a href="/admin/owner">店舗代表者一覧</a></li>
            <li class='list_content'><a href="/admin/mail">利用者へお知らせメール送信</a></li>
            @endcan
            @can ('owner_only')
            <li class='list_content'><a href="/admin/reserve">予約状況一覧</a></li>
            <li class='list_content'><a href="/admin/shop/index">店舗情報一覧</a></li>
            @endcan
        </ul>
    </div>

    <form action="{{route('admin.logout')}}" method="post">
        @csrf
        <button class="admin__logout">Logout</button>
    </form>

    @endsection
</main>