@extends('layouts.app')


<head>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<!-- @section('title', '打刻ページ')
@section('content') -->


<main>




    <!-- カード一覧 -->
    <div class="card_contents">
        @foreach ($shops as $shop)
        <div class="card_contents_inner_1">
            <div>
                <img class="image" src="{{ $shop->image_url }}">
            </div>
            <div class="shop_name">
                <h2 class="shop_name1">{{ $shop->name }}</h2>
                <div class="shop_name2">

                    <span>#{{ $shop['area']['name'] }}</span>
                    <span>#{{ $shop['genre']['name'] }}</span>
                </div>

                <div class="card_contents_inner_2">
                    <a class="detail" href="{{ url('/detail/'.$shop['id']) }}">詳しくみる</a>
                    @if( Auth::check() )
                    <form method="POST" action="{{ url('/favorite') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                        <button class="favorite_button  {{ $shop['favorite'] ? 'text-red-500' : 'text-gray-100' }}" type="submit">&#9829;</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>





    <form method="GET" action="{{ route('shop.index') }}">
        <div class="form-row justify-content-center">
            <div class="col-md-4 mb-3">
                <label class="mr-sm-2 sr-only" for="a">AreaSearch</label>
                <select class="custom-select mr-sm-2" id="a" name="a">
                    <option value="">エリア検索</option>
                    @foreach($areas as $area)
                    <option value="{{ $area->id }}" @if($a==$area->id) selected @endif>{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="mr-sm-2 sr-only" for="a">GenreSearch</label>
                <select class="custom-select mr-sm-2" id="g" name="g">
                    <option value="">ジャンル検索</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" @if($g==$genre->id) selected @endif>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- <div class="col-md-4 mb-3">
                <label class="mr-sm-2 sr-only" for="s">StarSearch</label>
                <select class="custom-select mr-sm-2" id="s" name="s">
                    <option value="">星の数</option>
                    @for($i=5; $i>=1; $i--)
                    <option value="{{ $i }}" @if($s==$i) selected @endif>★ x {{ $i }}</option>
                    @endfor
                </select>
            </div> -->
        </div>
        <div class="form-row justify-content-center">
            <div class="col-md-8 mb-3">
                <label class="mr-sm-2 sr-only" for="s">ショップ名検索</label>
                <input name="s" class="form-control mr-sm-2" id="s" type="search" placeholder="ショップ名検索" aria-label="Search" value="{{ $s }}">
            </div>
            <div class="col-md-8 mb-3">
                <!-- <label class="mr-sm-2 sr-only" for="search">検索</label>
                <button class="btn btn-info btn-block mr-sm-2" id="search" type="submit">検索</button> -->
            </div>
        </div>
    </form>



</main>