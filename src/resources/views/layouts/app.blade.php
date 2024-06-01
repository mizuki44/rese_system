<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

<header class="header">
    <div class="header__inner">
        <div class="header-utilities">

            <a class="header__logo" href="/">
                Rese
            </a>
            
<!-- ハンバーガーメニュー -->
            <header class="header">
                <div class="header__inner">
                    <h1 class="header__title header-title">
                        <a href="#">
                            logo
                        </a>
                    </h1>

                    <nav class="header__nav nav" id="js-nav">
                        <ul class="nav__items nav-items">
                            <li class="nav-items__item"><a href="">メニュー</a></li>
                            <li class="nav-items__item"><a href="">メニュー</a></li>
                            <li class="nav-items__item"><a href="">メニュー</a></li>
                            <li class="nav-items__item"><a href="">メニュー</a></li>
                        </ul>
                    </nav>

                    <button class="header__hamburger hamburger" id="js-hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </header>

        </div>
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
    @yield('content')
</main>

<footer>
    <small>Rese, Inc.</small>
</footer>

</body>

</html>