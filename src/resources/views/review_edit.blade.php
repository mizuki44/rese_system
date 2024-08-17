<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
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

<body>


    <div class="content">
        <p class="comment">レビュー変更ページ</p>
            <div class="card_contents_inner_1">
            <form method="POST" action="{{ url('/review/update') }}" enctype="multipart/form-data">
                @csrf
                <div class="card_contents_inner_2">
                    <img class="image" src="{{ $shop['image_url'] }}">
                    <div class="shop_name">
                        <h2 class="shop_name1">{{ $shop['name'] }}</h2>
                        <div class="shop_name2">
                            <span>#{{ $shop['area']['name'] }}</span>
                            <span>#{{ $shop['genre']['name'] }}</span>
                        </div>
                        <a href="{{ url('/detail/'.$shop['id']) }}">店舗詳細へ</a>
                    </div>
                    <div class="card_contents_inner_3">
                        <p>体験を評価してください</p>
                        <div class="star">
                            <!-- 星ラジオボタン -->
                            <input type="radio" id="star5" name="star" value=5 class="hidden peer" {{ 5 == $review['star'] ? "checked" : "" }}>
                            <label for="star5" class="">5★</label>
                            <input type="radio" id="star4" name="star" value=4 class="hidden peer" {{ 4 == $review['star'] ? "checked" : "" }}>
                            <label for="star4" class="">4★</label>
                            <input type="radio" id="star3" name="star" value=3 class="hidden peer" {{ 3 == $review['star'] ? "checked" : "" }}>
                            <label for="star3" class="">3★</label>
                            <input type="radio" id="star2" name="star" value=2 class="hidden peer" {{ 2 == $review['star'] ? "checked" : "" }}>
                            <label for="star2" class="">2★</label>
                            <input type="radio" id="star1" name="star" value=1 class="hidden peer" {{ 1 == $review['star'] ? "checked" : "" }}>
                            <label for="star1" class="">1★</label>
                        </div>
                        @error('star')
                        <p class='error_message'>{{$message}}</p>
                        @enderror
                        <p class="comment_p">コメント</p>
                        <!-- コメントテキストエリア -->
                        <textarea name="comment" class="textarea" onkeyup="ShowLength(value)">{{ $review['comment'] }}</textarea>
                        <div class="">
                            <span id="inputlength">0</span>
                            <span>/400(最大文字数)</span>
                        </div>
                        @error('comment')
                        <p class='error_message'>{{$message}}</p>
                        @enderror
                    </div>
                    <div class="card_contents_inner_4">
                        <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <button type="submit" class="review_button">口コミを変更</button>
                    </div>
                </div>
            </div>
            </form>
    </div>

</body>












<!-- <div class="max-w-7xl mx-auto px-4 lg:px-8">
    <form method="POST" action="{{ url('/review/update') }}" enctype="multipart/form-data">
        @csrf
        <div class="md:flex md:justify-between md:flex-wrap md:divide-x-2">
            <div class="content">
                <p class="comment">今回のご利用はいかがでしたか？</p>
                <div class="card_contents_inner_1">
                    <div>
                        <img class="shop_img" src="{{ $shop['image_url'] }}">
                    </div>
                    <div class="p-3">
                        <h2 class="font-bold">{{ $shop['name'] }}</h2>
                        <div class="text-xs">
                            <span>#{{ $shop['area']['name'] }}</span>
                            <span>#{{ $shop['genre']['name'] }}</span>

                        </div>
                        <div class="flex justify-between items-center mt-2"> -->
<!-- <a class="text-xs h-6 rounded-md bg-blue-600 text-white px-3 pt-1" href="{{ url('/detail/'.$shop['id']) }}">詳しくみる</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:w-3/5 px-6">
                <p>体験を評価してください</p>
                <div class="flex flex-row-reverse justify-end">
                    <input type="radio" id="star5" name="star" value=5 class="hidden peer" {{ 5 == $review['star'] ? "checked" : "" }}>
                    <label for="star5" class="relative py-0 px-[5px] text-gray-200 cursor-pointer text-[35px] hover:text-blue-600 peer-hover:text-blue-600 peer-checked:text-blue-600">★</label>
                    <input type="radio" id="star4" name="star" value=4 class="hidden peer" {{ 4 == $review['star'] ? "checked" : "" }}>
                    <label for="star4" class="relative py-0 px-[5px] text-gray-200 cursor-pointer text-[35px] hover:text-blue-600 peer-hover:text-blue-600 peer-checked:text-blue-600">★</label> -->
<!-- <input type="radio" id="star3" name="star" value=3 class="hidden peer" {{ 3 == $review['star'] ? "checked" : "" }}>
                    <label for="star3" class="relative py-0 px-[5px] text-gray-200 cursor-pointer text-[35px] hover:text-blue-600 peer-hover:text-blue-600 peer-checked:text-blue-600">★</label>
                    <input type="radio" id="star2" name="star" value=2 class="hidden peer" {{ 2 == $review['star'] ? "checked" : "" }}>
                    <label for="star2" class="relative py-0 px-[5px] text-gray-200 cursor-pointer text-[35px] hover:text-blue-600 peer-hover:text-blue-600 peer-checked:text-blue-600">★</label>
                    <input type="radio" id="star1" name="star" value=1 class="hidden peer" {{ 1 == $review['star'] ? "checked" : "" }}>
                    <label for="star1" class="relative py-0 px-[5px] text-gray-200 cursor-pointer text-[35px] hover:text-blue-600 peer-hover:text-blue-600 peer-checked:text-blue-600">★</label>
                </div>
                <div class="text-red-600">
                    @error('star')
                    <p class='error_message'>{{$message}}</p>
                    @enderror
                </div>
                <p class="mt-6">コメント</p>
                <div>
                    <textarea name="comment" class="w-full h-32" onkeyup="ShowLength(value)">{{ $review['comment'] }}</textarea> -->
<!-- <div class="text-xs text-end">
                        <span id="inputlength">0</span>
                        <span>/400(最大文字数)</span>
                    </div>
                    <div class="text-red-600">
                        @error('comment')
                        <p class='error_message'>{{$message}}</p>
                        @enderror
                    </div>
                </div>

            </div>
        </div>
</div>
</div>
</div>
<div class="my-6 text-center">
    <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <button type="submit" class="text-blue-800 bg-white border-solid border border-blue-800 hover:bg-gray-200 rounded-full w-80">口コミを変更</button>
</div>
</form> -->

<!-- </div> -->