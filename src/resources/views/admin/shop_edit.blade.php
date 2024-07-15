    <!-- モーダル開始 -->
    <div class="overlay" id="js-overlay">店舗情報変更</div>
    <div class="modal" id="js-modal">
        <div class="modal-close__wrap">
            <button class="modal-close js-close" id="js-close">
                <sp>×</sp>
            </button>
        </div>
        <form method="POST" action="{{url('/admin/shop/update')}}">
            <input type="hidden" name="shop_id" id="shop_id" value="{{ $item['id'] }}">
            @csrf
            <table class='reserve_content'>
                <tr class="name_low">
                    <th class="title">店舗名</th>
                    <td>
                        <textarea name="name" class="w-full h-32" onkeyup="ShowLength(value)">{{ $item['name'] }}</textarea>
                        <div class="text-xs text-end">
                            <span id="inputlength"></span>
                        </div>
                        <div class="text-red-600">
                            @error('name')
                            ※{{ $message }}
                            @enderror
                        </div>
                    </td>
                </tr>



                <tr class="area_low">
                    <th class="title">エリア</th>
                    <td>
                        <div class="drop_area">
                            <select name="area" class="drop_area" id="area">
                                <option value="{{ $item->area_id}}" selected hidden>{{ $item->area->name }}</option>
                                <option value=" 1">東京都</option>
                                <option value="2">大阪府</option>
                                <option value="3">福岡県</option>
                            </select>
                        </div>
                    </td>
                    @error('area')
                    <p class='error_message'>{{$message}}</p>
                    @enderror
                </tr>
                <tr class="genre_low">
                    <th class="title">ジャンル</th>
                    <td>
                        <div class="drop_genre">
                            <select name="genre" class="drop_genre" id="genre">
                                <option value="{{ $item->genre_id}}" selected hidden>{{ $item->genre->name }}</option>
                                <option value=" 1">寿司</option>
                                <option value="2">焼肉</option>
                                <option value="3">居酒屋</option>
                                <option value="4">イタリアン</option>
                                <option value="5">ラーメン</option>
                            </select>
                        </div>
                    </td>
                    @error('genre')
                    <p class='error_message'>{{$message}}</p>
                    @enderror
                </tr>

                <tr class="description_low">
                    <th class="title">説明</th>
                    <td>
                        <textarea name="description" class="w-full h-32" onkeyup="ShowLength(value)">{{ $item['description'] }}</textarea>
                        <div class="text-xs text-end">
                            <span id="inputlength"></span>
                        </div>
                        <div class="text-red-600">
                            @error('description')
                            ※{{ $message }}
                            @enderror
                        </div>
                    </td>
                </tr>

                <tr class="image_url_low">
                    <th class="title">イメージURL</th>
                    <td>
                        <textarea name="image_url" class="w-full h-32" onkeyup="ShowLength(value)">{{ $item['image_url'] }}</textarea>
                        <div class="text-xs text-end">
                            <span id="inputlength"></span>
                        </div>
                        <div class="text-red-600">
                            @error('image_url')
                            ※{{ $message }}
                            @enderror
                        </div>
                    </td>
                </tr>

            </table>
            <div class="button_css">
                <!-- <form method="POST" action="{{url('/admin/shop/update')}}">
                    @csrf -->
                <!-- <input type="hidden" name="shop_id" class="shop_for_modal" value=""> -->
                <button type="submit" class=" change_button">変更する</button>
        </form>
    </div>
    </form>
    </div>
    <!-- モーダル終了 -->
    <button type="button" onClick="history.back()">戻る</button>