@extends('layouts.app')

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
    @yield('css')
</head>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropZone = document.getElementById('drop-zone');
        var fileInput = document.getElementById('file-input');
        var displayElement = document.getElementById('contents');

        dropZone.addEventListener('dragover', function(e) {
            e.stopPropagation();
            e.preventDefault();
            this.style.background = '#e1e7f0';
        }, false);

        dropZone.addEventListener('dragleave', function(e) {
            e.stopPropagation();
            e.preventDefault();
            this.style.background = 'rgb(243, 244, 246)';
        }, false);

        dropZone.addEventListener('drop', function(e) {
            e.stopPropagation();
            e.preventDefault();
            this.style.background = 'rgb(243, 244, 246)';
            var files = e.dataTransfer.files;
            if (files.length > 1) return alert('アップロードできるファイルは1つだけです');
            fileInput.files = files;
            displayElement.textContent = files[0].name;
        }, false);

        dropZone.addEventListener('click', (e) => {
            fileInput.addEventListener('change', (e) => {
                const file = e.target.files[0];

                const reader = new FileReader();
                reader.onload = (e) => {
                    const fileContents = e.target.result;
                    displayElement.textContent = file.name;
                }
                reader.readAsText(file);
                fileInput.files = e.target.files;
            }, false);

            fileInput.click();
        }, false);
        var stars = document.getElementsByClassName("star_mark");
        var star_form = document.getElementById("star_form");
        var clicked = false;
        for (let i = 0; i < star_form.value; i++) {
            if (i < star_form.value) {
                console.log(i);
                stars[i].style.color = "blue";
            } else {
                stars[1].style.color = "gray";
            }
        }

        for (let i = 0; i < stars.length; i++) {
            stars[i].addEventListener(
                "click",
                () => {
                    clicked = true;
                    for (let j = 0; j <= i; j++) {
                        stars[j].style.color = "blue";
                    }
                    for (let j = i + 1; j < stars.length; j++) {
                        stars[j].style.color = "gray";
                    }
                    star_form.value = i + 1;
                },
                false
            );
        }
    });

    function ShowLength(str) {
        document.getElementById("inputlength").innerHTML = str.length;
    }
</script>

<main>
    @section('content')
    <div class="separate__content">
        <div class="left__side">
            <p class="comment">今回のご利用はいかがでしたか？</p>
            <div class="card_contents">
                <div class="card_contents_inner">
                    <img class="image" src="{{ $shop['image_url'] }}">
                    <div class="shop_name">
                        <h2 class="shop_name_font">{{ $shop->name }}</h2>
                        <div class="shop_name_inner">
                            <span>#{{ $shop['area']['name'] }}</span>
                            <span>#{{ $shop['genre']['name'] }}</span>
                        </div>
                        <div class="card_contents_inner_detail">
                            <a class="detail" href="{{ url('/detail/'.$shop['id']) }}">詳しくみる</a>
                            @if( Auth::check() )
                            <form method="POST" action="{{ url('/favorite') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                                <button class="heart"><img class="image" src="{{ Auth::user()->favorites->where('shop_id', $shop->id)->first->id ? url('../img/red_heart.jpeg') : url('../img/gray_heart.jpeg')}}"></button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ url('/review/update') }}" enctype="multipart/form-data">
            @csrf
            <div class="right__side">
                <p class="comment_p">体験を評価してください</p>
                <div class="star_box">
                    <input type="hidden" id="star_form" name="star" value="{{$review['star']}}">
                    <span class="star_mark" id="1">★</span>
                    <span class="star_mark" id="2">★</span>
                    <span class="star_mark" id="3">★</span>
                    <span class="star_mark" id="4">★</span>
                    <span class="star_mark" id="5">★</span>
                </div>
                @error('star')
                <p class='error_message'>{{$message}}</p>
                @enderror
                <p class="comment_p">口コミを変更</p>
                <textarea name="comment" class="textarea" onkeyup="ShowLength(value)">{{ $review['comment'] }}</textarea>
                <div class="character__count">
                    <span id="inputlength">0</span>
                    <span>/400(最大文字数)</span>
                </div>
                @error('comment')
                <p class='error_message'>{{$message}}</p>
                @enderror
                <p class="comment_p">画像の変更</p>
                @if($review->image_url)
                <img class="review__image" src="{{ $review['image_url'] }}" />
                @endif
                <div id="drop-zone" class="drop-zone">
                    <p>クリックして写真を追加</p><br>
                    <p>またはドロッグアンドドロップ</p>
                    <input type="file" name="image_url" id="file-input" class="custom-upload_input">
                    <pre><code id="contents"></code></pre>
                </div>
                @error('image_url')
                <p class='error_message'>{{$message}}</p>
                @enderror
                </div>
            </div>
            <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <button type="submit" class="review_button">口コミを変更</button>
        </form>
    @endsection
</main>