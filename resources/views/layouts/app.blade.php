<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>URATABI</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .navbar-toggler .navbar-toggler-icon {
         background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255,255,255,1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
        }
        .navbar-toggler{
            background-color:#FB6E86;
        }
        .navbar-toggler{
        color:white !important; 
        border:2px solid #FB6E86 !important;
        }
        .pink{
            background-color:#FB6E86;
            border-color:#FB6E86;
        }
        .bg-f-part{
            background-color:#343a40;
        }
        .f-pink{
            background-color:#BB4156;
            
        }
        ul{
            list-style-type: none
        }
        a{
            text-decoration:none;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm pink">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    <img src="/images/rogo.png" alt="" style="width:140px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                    <a class="nav-link text-white fw-bold" href="/cart">カート</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/home">マイページ</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        ログアウト
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>

        <footer class="mt-4">
        <div class="bg-f-part py-3">
            <h2 class="text-center text-white mb-0">観光協会</h2>
        </div>
        <div class ="f-pink">
            <div class="d-flex py-4 justify-content-center">
                <div class="me-4">
                    <ul>
                        <li class="my-2"><a href="#" class="text-white">プログラム一覧</a></li>
                        <li class="my-2"><a href="#" class="text-white">商品一覧</a></li>
                        <li class="my-2"><a href="#" class="text-white">支払い方法</a></li>
                    </ul>
                </div>
                <div class="ms-4">
                    <ul>
                        <li class="my-2"><a href="#" class="text-white">キャンセル・返品について</a></li>
                        <li class="my-2"><a href="#" class="text-white">特定商取引に基づく表記</a></li>
                        <li class="my-2"><a href="#" class="text-white">プライバシーポリシー</a></li>
                    </ul>
                </div>
            </div>
            <div class="d-md-flex justify-content-between align-items-center text-center">
                <p class="text-white ps-md-4 small">Copyright© 観光協会 All rights reserved.</p>
                <p class="text-white pe-md-4 mb-0 pb-3"><small>Powered by  <img src="/images/rogo.png" alt="" style="width:140px"></small></p>
             </div>
        </div>
        
        

        
    <footer>

    </div>
</body>
</html>
