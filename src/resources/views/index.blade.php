<!DOCTYPE html>
<html lang="ja">




<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

<!-- <header class="header">
    <div class="header__inner">
        <div class="header-utilities">

            <a class="header__logo" href="/">
                Rese
            </a> -->

<body>
    <!-- ハンバーガーメニュー -->
    <header class="header">
        <div class="header__inner">


            @if( Auth::check() )
            <nav class="header__nav nav" id="js-nav">
                <ul class="nav__items nav-items">
                    <li class="nav-items__item"><a href="/">Home</a></li>
                    <li class="nav-items__item">
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button class="nav__logout">Logout</button>
                        </form>
                    </li>
                    <li class="nav-items__item"><a href="/my_page">Mypage</a></li>
                </ul>
            </nav>
            @endif


            <nav class="header__nav nav" id="js-nav">
                <ul class="nav__items nav-items">
                    <li class="nav-items__item"><a href="/">Home</a></li>
                    <li class="nav-items__item"><a href="/register">Register</a></li>
                    <li class="nav-items__item"><a href="/login">Login</a></li>
                </ul>
            </nav>

            <div class="logo_hamburger">
                <div class="logo_hamburger_1">
                    <button class=" header__hamburger hamburger" id="js-hamburger">
                        <span class="span_1"></span>
                        <span class="span_2"></span>
                        <span class="span_3"></span>
                    </button>
                </div>
                <div class="header__inner">
                    <h1 class="header__title header-title">
                        <a href="/">
                            Rese
                        </a>
                    </h1>
                </div>
            </div>


            <!-- 検索メニュー -->
            <form method="GET" action="{{ route('shop.index') }}">
                <div class="search_content">
                    <div class="search_content2">
                        <select class="search_content_area" id="a" name="a">
                            <option value="">All area</option>
                            @foreach($areas as $area)
                            <option value="{{ $area->id }}" @if($a==$area->id) selected @endif>{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search_content2">
                        <select class="search_content_genre" id="g" name="g">
                            <option value="">All genre</option>
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

                    <div class="search_box">
                        <!-- <label class="mr-sm-2 sr-only" for="s">ショップ名検索</label> -->
                        <input name="s" class="search_content_shop" id="s" type="search" placeholder="Search..." aria-label="Search" value="{{ $s }}">
                    </div>
                    <!-- <div class="col-md-8 mb-3"> -->
                    <!-- <label class="mr-sm-2 sr-only" for="search">検索</label>
                <button class="btn btn-info btn-block mr-sm-2" id="search" type="submit">検索</button> -->
                </div>
            </form>



        </div>




        <script>
            const ham = document.querySelector('#js-hamburger');
            const nav = document.querySelector('#js-nav');

            ham.addEventListener('click', function() {
                ham.classList.toggle('active');
                nav.classList.toggle('active');

            });
        </script>
    </header>


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
                            <!-- <button class="favorite_button  {{ Auth::user()->favorites->where('shop_id', $shop->id)->first->id ? 'color_red' : 'color_gray' }}" type="submit">&#9829;</button> -->

                            <button class="heart"><img class="image" src="{{ Auth::user()->favorites->where('shop_id', $shop->id)->first->id ? url('../img/red_heart.jpeg') : url('../img/gray_heart.jpeg')}}"></button>
                            <!-- whereは複数検索する（箱）。'shop_id'と$shop->idが一致していたらfirstで取り出す（箱から取り出す）。 -->
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>


        <!-- <form method="GET" action="{{ route('shop.index') }}">
            <div class="search_content">
                <div class="search_content2">
                    <select class="search_content_area" id="a" name="a">
                        <option value="">All area</option>
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}" @if($a==$area->id) selected @endif>{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="search_content2">
                    <select class="search_content_genre" id="g" name="g">
                        <option value="">All genre</option>
                        @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" @if($g==$genre->id) selected @endif>{{ $genre->name }}</option>
                        @endforeach
                    </select>
                </div> -->
        <!-- <div class="col-md-4 mb-3">
                <label class="mr-sm-2 sr-only" for="s">StarSearch</label>
                <select class="custom-select mr-sm-2" id="s" name="s">
                    <option value="">星の数</option>
                    @for($i=5; $i>=1; $i--)
                    <option value="{{ $i }}" @if($s==$i) selected @endif>★ x {{ $i }}</option>
                    @endfor
                </select>
            </div> -->

        <!-- <div class="search_box">
                    <input name="s" class="search_content_shop" id="s" type="search" placeholder="Search..." aria-label="Search" value="{{ $s }}">
                </div>
            </div>
        </form> -->

    </main>


    <!-- <footer>
        <small>Rese, Inc.</small>
    </footer> -->

</body>



</html>