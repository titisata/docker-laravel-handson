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
    <!-- <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .navbar-toggler .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgb(73, 70, 69, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
            }
    
            .navbar-toggler{
            color:white !important;
            
            }
            .text-gray-color{
                color:#494645;
            }
            .btn-pink:hover{
                background-color:white;
                color:#FB6E86;
            }
            .btn-color{
                background-color:#f4f4f4;
            }
            .btn-text{
                color:#100f49;

            }
          
            .font-gray{
                color:#848283;
            }

            ul{
                list-style-type: none
            }
            a{
                text-decoration:none;
            }
            .d-block{
                max-height:440px;
                object-fit: cover;

            }
            .cell{
                width:200px;
            }
            .search_area{
                width:360px!important;
            }
            .bg-winered{
                background-color:#AB0707;
                height:20px;
            }
            .offset-sm{
                margin-left:3.333333%;
            }
            .col-set{
                width:71.666667%
            }
        </style> -->
    </head>
    <body class="bg-light">
        <div>
            <nav class="navbar navbar-expand-md navbar-light shadow-sm bg-dark d-flex align-items-center justify-content-between">
                <!-- <div class="d-flex align-items-center justify-content-between"> -->
                <div class="container-fluid">
                    <a class="navbar-brand  text-gray-color" href="">
                        <img src="/images/logo_sample.png" alt="" class="ms-4 logo">
                    </a>
                    <div class="collapse navbar-collapse align-items-center" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto align-items-center">
                            <li class="me-5">
                                <div class="input-group">
                                    <input type="text" class="form-control search_area" placeholder="商品名、ブランド等で検索ができます" aria-label="Username" aria-describedby="input-group-button-right">
                                    <button type="button" class="btn btn-secondary" id="input-group-button-right">検索</button>
                                </div>
                            </li>

                            <li class='me-3'>
                                <a href="#" class='text-white'>
                                    ログイン
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <button class='btn btn-warning'>
                                        <i class="bi bi-cart3"></i>カートへ
                                    </button>
                                </a>
                            </li>
                           
                        </ul>
                    </div>
                </div>
            </nav>

            <nav class="navbar navbar-expand-md bg-winered">
                
            </nav>

        <main class="">
            @yield('content')
        </main>

        <footer class="mt-4">
            <div class='bg-winered'>

            </div>
            <div class="bg-dark py-3">
                <div class='ms-4'>
                    <img src="/images/logo_sample.png" alt="" class="logo">
                </div>
                
            
                <div class="d-flex py-4 justify-content-start ms-4">
                    <div class="me-4">
                        <ul>
                            <li class="my-2"><a href="/link/1" class="text-white">利用規約</a></li>
                            <li class="my-2"><a href="/link/2" class="text-white">プライバシー規約</a></li>
                            <li class="my-2"><a href="/link/3" class="text-white">特定商取引に基づく表記</a></li>
                        </ul>
                    </div>
                    <div class="ms-4">
                        <ul>
                            <li class="my-2"><a href="/link/4" class="text-white">店舗情報</a></li>
                            <li class="my-2"><a href="/link/5" class="text-white">マニュアル</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <footer>
    </div>
</body>
</html>
