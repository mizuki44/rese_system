@extends('layouts.app')


<head>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css')
</head>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropZone = document.getElementById('drop-zone');
        var preview = document.getElementById('preview');
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
            previewFile(files[0]);
        }, false);

        fileInput.addEventListener('change', function() {
            previewFile(this.files[0]);
        });

        // 追加した分
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

        // 星評価
        var stars = document.getElementsByClassName("star_mark");
        var star_form = document.getElementById("star_form");
        var clicked = false;

        for (let i = 0; i < stars.length; i++) {
            stars[i].addEventListener(
                "mouseover",
                () => {
                    if (!clicked) {
                        for (let j = 0; j <= i; j++) {
                            stars[j].style.color = "blue";
                        }
                    }
                },
                false
            );
            stars[i].addEventListener(
                "mouseout",
                () => {
                    if (!clicked) {
                        for (let j = 0; j < stars.length; j++) {
                            stars[j].style.color = "gray";
                        }
                    }
                },
                false
            );
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



    function previewFile(file) {
        var fr = new FileReader();
        fr.readAsDataURL(file);
        fr.onload = function() {
            var img = document.createElement('img');
            img.setAttribute('src', fr.result);
            preview.innerHTML = '';
            preview.appendChild(img);
        };
    }

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
        <div class="right__side">
            <form method="POST" action="{{ url('/review/store') }}" enctype="multipart/form-data">
                @csrf
                <p class="comment_p">体験を評価してください</p>
                <div class="star_box">
                    <input type="hidden" id="star_form" name="star" value="">
                    <span class="star_mark" id="1">★</span>
                    <span class="star_mark" id="2">★</span>
                    <span class="star_mark" id="3">★</span>
                    <span class="star_mark" id="4">★</span>
                    <span class="star_mark" id="5">★</span>
                </div>
                @error('star')
                <p class='error_message'>{{$message}}</p>
                @enderror
                <p class="comment_p">口コミを投稿</p>
                <!-- コメントテキストエリア -->
                <textarea name="comment" class="textarea" onkeyup="ShowLength(value)" placeholder="カジュアルな夜のお出かけにおすすめのスポット"></textarea>
                <div class="character__count">
                    <span id="inputlength">0</span>
                    <span>/400(最大文字数)</span>
                </div>
                @error('comment')
                <p class='error_message'>{{$message}}</p>
                @enderror
                <!-- 画像アップロード -->

                <!-- <div class="drop-area" id="drop-area">
                <p>アップロードするファイルをドラッグするか、クリックして選択してください</p>
                <input type="file" name="image_url" id="image_url" onchange="handleFiles(this.files)">
                <div class="gallery" id="gallery"></div>
            </div> -->
                <p class="comment_p">画像の追加</p>
                <div id="drop-zone" class="drop-zone">
                    <p>クリックして写真を追加<br>またはドロッグアンドドロップ</p>
                    <!-- <label for="upload" class="custom-upload">画像を選択 -->
                    <input type="file" name="image_url" id="file-input" class="custom-upload_input">
                    <!-- 追加した分 -->
                    <pre><code id="contents"></code></pre>
                </div>

                @error('image_url')
                <p class='error_message'>{{$message}}</p>
                @enderror
        </div>
        <!-- <div class=" button"> -->
        <!-- <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <button type="submit" class="review_button">口コミを投稿</button> -->
        <!-- </div> -->
    </div>
    <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <button type="submit" class="review_button">口コミを投稿</button>
    </form>
    </div>

    </div>
    @endsection
</main>