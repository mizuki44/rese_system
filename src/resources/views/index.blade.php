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

<body>
    <!-- ヘッダー -->
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
                <button class=" header__hamburger_for_index hamburger" id="js-hamburger">
                    <span class="span_1"></span>
                    <span class="span_2"></span>
                    <span class="span_3"></span>
                </button>
                <div class="header__inner">
                    <a href="/" class="header__title">
                        Rese
                    </a>
                </div>
            </div>

            <form method="GET" action="{{ url('/') }}" id="sort_form">
                @csrf
                <select class="search_content_sort" id="search_content_sort" name="sort_option">
                    @foreach (App\Models\Shop::SORT_LIST as $key => $value)
                    <option value="{{ $key }}" @if($sort_option==$key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
            </form>
            <!-- 検索メニュー -->
            <form method="GET" action="{{ route('shop.index') }}">
                <div class="search_content">
                    <select class="search_content_area" id="a" name="a">
                        <option value="">All area</option>
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}" @if($a==$area->id) selected @endif>{{ $area->name }}</option>
                        @endforeach
                    </select>
                    <select class="search_content_genre" id="g" name="g">
                        <option value="">All genre</option>
                        @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" @if($g==$genre->id) selected @endif>{{ $genre->name }}</option>
                        @endforeach
                    </select>
                    <div class="search_box">
                        <input name="s" class="search_content_shop" id="s" type="search" placeholder="Search..." aria-label="Search" value="{{ $s }}">
                    </div>
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
            var sort_select_box = document.getElementById('search_content_sort');
            var sort_form = document.getElementById('sort_form');
            sort_select_box.addEventListener('change', function() {
                sort_form.submit();
            });
        </script>
    </header>

    <!-- メイン -->
    <main>
        <!-- カード一覧 -->
        <div class="card_contents">
            @foreach ($shops as $shop)
            <div class="card_contents_inner">
                <img class="image" src="{{ $shop->image_url }}">
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
            @endforeach
        </div>
    </main>
</body>



</html>