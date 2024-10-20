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
        var preview = document.getElementById('preview');
        var fileInput = document.getElementById('file-input');

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
            previewFile(files[0]);
        }, false);

        fileInput.addEventListener('change', function() {
            previewFile(this.files[0]);
        });

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

<div class="content">
    <p class="comment">今回のご利用はいかがでしたか？</p>
    <div class="card_contents">
        <form method="POST" action="{{ url('/review/store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card_contents_inner">
                <img class="image" src="{{ $shop['image_url'] }}">
                <div class="shop_name">
                    <h2 class="shop_name_font">{{ $shop['name'] }}</h2>
                    <div class="shop_name_inner">
                        <span>#{{ $shop['area']['name'] }}</span>
                        <span>#{{ $shop['genre']['name'] }}</span>
                    </div>
                    <a href="{{ url('/detail/'.$shop['id']) }}">店舗詳細へ</a>
                </div>
                <p>体験を評価してください</p>
                <div class="star">
                    <!-- 星ラジオボタン -->
                    <input type="radio" id="star5" name="star" value=5 class="hidden peer">
                    <label for="star5" class="">5★</label>
                    <input type="radio" id="star4" name="star" value=4 class="hidden peer">
                    <label for="star4" class="">4★</label>
                    <input type="radio" id="star3" name="star" value=3 class="hidden peer">
                    <label for="star3" class="">3★</label>
                    <input type="radio" id="star2" name="star" value=2 class="hidden peer">
                    <label for="star2" class="">2★</label>
                    <input type="radio" id="star1" name="star" value=1 class="hidden peer">
                    <label for="star1" class="">1★</label>
                </div>
                @error('star')
                <p class='error_message'>{{$message}}</p>
                @enderror
                <p class="comment_p">コメント</p>
                <!-- コメントテキストエリア -->
                <textarea name="comment" class="textarea" onkeyup="ShowLength(value)"></textarea>
                <span id="inputlength">0</span>
                <span>/400(最大文字数)</span>
                @error('comment')
                <p class='error_message'>{{$message}}</p>
                @enderror
                <!-- 画像アップロード -->
                <input type="file" name="image_url" id="image_url" /><br>
                {{ csrf_field() }}
                @error('image_url')
                <p class='error_message'>{{$message}}</p>
                @enderror
                <div class="button">
                    <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <button type="submit" class="review_button">口コミを投稿</button>
                </div>
            </div>
        </form>
    </div>
</div>