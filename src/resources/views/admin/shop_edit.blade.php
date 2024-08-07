<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/admin_shop_edit.css">
</head>

<body>



    <!-- モーダル開始 -->
    <div class="contact">
        <div class="contact-ttl" id="js-overlay">店舗情報変更</div>
        <form method="POST" action="{{url('/admin/shop/update')}}">
            <input type="hidden" name="shop_id" id="shop_id" value="{{ $item['id'] }}">
            @csrf
            <table class='contact-table'>
                <tr class="">
                    <th class="contact-item">店舗名</th>
                    <td class="contact-body">
                        <textarea name="name" class="form-textarea" onkeyup="ShowLength(value)">{{ $item['name'] }}</textarea>
                        <div class="text-xs text-end">
                            <span id="inputlength"></span>
                        </div><br>
                        @error('name')
                        <p class='error_message'>{{$message}}</p>
                        @enderror
                    </td>
                </tr>



                <tr class="">
                    <th class="contact-item">エリア</th>
                    <td class="contact-body">
                        <div class="drop_area">
                            <select name="area_id" class="form-select" id="area">
                                <option value="{{ $item->area_id}}" selected hidden>{{ $item->area->name }}</option>
                                <option value=" 1">東京都</option>
                                <option value="2">大阪府</option>
                                <option value="3">福岡県</option>
                            </select>
                        </div>
                    </td><br>
                    @error('area')
                    <p class='error_message'>{{$message}}</p>
                    @enderror
                </tr>
                <tr class="">
                    <th class="contact-item">ジャンル</th>
                    <td class="contact-body">
                        <div class="drop_genre">
                            <select name="genre_id" class="form-select" id="genre">
                                <option value="{{ $item->genre_id}}" selected hidden>{{ $item->genre->name }}</option>
                                <option value=" 1">寿司</option>
                                <option value="2">焼肉</option>
                                <option value="3">居酒屋</option>
                                <option value="4">イタリアン</option>
                                <option value="5">ラーメン</option>
                            </select>
                        </div>
                    </td><br>
                    @error('genre')
                    <p class='error_message'>{{$message}}</p>
                    @enderror
                </tr>

                <tr class="">
                    <th class="contact-item">説明</th>
                    <td class="contact-body">
                        <textarea name="description" class="form-textarea" onkeyup="ShowLength(value)">{{ $item['description'] }}</textarea>
                        <div class="text-xs text-end">
                            <span id="inputlength"></span>
                        </div><br>
                        @error('description')
                        <p class='error_message'>{{$message}}</p>
                        @enderror
                    </td>
                </tr>

                <tr class="">
                    <th class="contact-item">イメージURL</th>
                    <td class="contact-body">
                        <textarea name="image_url" class="form-textarea" onkeyup="ShowLength(value)">{{ $item['image_url'] }}</textarea>
                        <div class="text-xs text-end">
                            <span id="inputlength"></span>
                        </div><br>
                        @error('image_url')
                        <p class='error_message'>{{$message}}</p>
                        @enderror
                    </td>
                </tr>


            </table>
            <div class="button_css">
                <!-- <form method="POST" action="{{url('/admin/shop/update')}}">
                    @csrf -->
                <!-- <input type="hidden" name="shop_id" class="shop_for_modal" value=""> -->
                <button type="submit" class="contact-submit">変更する</button>
        </form>
    </div>
    </form>
    <a class="return" href="{{ route('admin.index') }}">戻る</a>
    </div>
</body>