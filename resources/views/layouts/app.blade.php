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
        /* .navbar-toggler .navbar-toggler-icon {
         background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255,255,255,1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
        } */
        .navbar-toggler .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgb(73, 70, 69, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
            }
            .navbar-toggler{
            color:white !important;
            
            }
        
        .text-gray-color{
                color:#494645;
        }
        .bg-f-part{
            background-color:#d1d1d1;
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
        <nav class="navbar navbar-expand-md navbar-light shadow-sm bg-white">
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
                                    <a class="nav-link  text-gray-color" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link  text-gray-color" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                    <a class="nav-link  text-gray-color fw-bold" href="/cart">カート</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle  text-gray-color fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                
                <h4 class="text-gray-color mb-0 ms-4 mt-4 fw-bold" style="padding-left:2rem"></h4>
            
                <div class="d-flex py-4 justify-content-start ms-4">
                    <div class="me-4">
                        <ul>
                            <li class="my-2"><a href="/link/1" class="text-gray-color">利用規約</a></li>
                            <li class="my-2"><a href="/link/2" class="text-gray-color">プライバシー規約</a></li>
                            <li class="my-2"><a href="/link/3" class="text-gray-color">特定商取引に基づく表記</a></li>
                        </ul>
                    </div>
                    <div class="ms-4">
                        <ul>
                            <li class="my-2"><a href="/link/4" class="text-gray-color">店舗情報</a></li>
                            <li class="my-2"><a href="/link/5" class="text-gray-color">ヘルプ・マニュアル</a></li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-column flex-md-row">
                    
                    
                    <h4 class="text-gray-color mb-0 ms-4 mt-4 fw-bold" style="padding-left:2rem"></h4>
                   
                    <p class="text-gray-color ms-4 ms-md-0 me-md-4 mb-0 pb-3" style="padding-right:2rem;padding-left:2rem;"><small>Powered by  <img src="/images/rogo.png" alt="" style="width:140px"></small></p>
                </div>
            </div>
        <footer>
    </div>
</body>
</html>
