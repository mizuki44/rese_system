@extends('layouts.app')

<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/reserve_done.css">
</head>

<main>
    @section('content')
    <div class="text_message">
        <div class="text_message_inner">
            @if ($item)
            <p class="messege_text">
                ご予約ありがとうございます。
            </p>
            <div class="back_button">
                <button class="back_button_2" onclick="history.back()">戻る</button>
            </div>
            @else
            <p class="">定員のためご予約できませんでした。</p>
            <div class="back_button">
                <a class="back_button_2" href="{{ route('/detail/{shop_id}') }}">戻る</a>
            </div>
            @endif
        </div>
    </div>
    @endsection
</main>