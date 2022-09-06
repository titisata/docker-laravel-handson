<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>URATABI</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- bootstrap5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- bootstrap icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <style>
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

            .bg-f-part{
                background-color:#d1d1d1;
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
            .d-block{
                height:400px;
                object-fit: cover;

            }
        </style>
    </head>
    <body class="antialiased">
        <div>
            <nav class="navbar navbar-expand-md navbar-light shadow-sm bg-white d-flex align-items-center justify-content-between">
                <!-- <div class="d-flex align-items-center justify-content-between"> -->
                <div class="container">
                    <a class="navbar-brand  text-gray-color" href="{{ url('/') }}">
                         <img src="/images/rogo.png" alt="" style="width:140px">
                    </a>
                    <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon text-gray-color"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            @if (Route::has('login'))

                                @auth
                                <li class="nav-item">
                                    <a href="{{ url('/home') }}" class="text-sm text-gray-color">ホーム</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="text-sm text-gray-color">ログイン</a>
                                </li>

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-color">新規登録</a>
                                        </li>
                                    @endif
                                @endauth

                            @endif
                        <ul>
                    </div>
                </div>
            </nav>

            <div class="">

            <div id="carouselWithControls" class="carousel slide" data-bs-ride="carousel">
                    <!-- スライドさせる画像の設定 -->
                    <div class="carousel-inner rounded-2">
                        @forelse($images as $key=>$image)
                            @if( $key == '1' )
                                <div class="carousel-item active">
                                    <img src="{{ $image->image_path }}" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide {{$key+1}}">
                                </div>
                            @else
                                <div class="carousel-item">
                                    <img src="{{ $image->image_path }}" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide {{$key+1}}">
                                </div>
                            @endif
                        @empty
                            <div class="carousel-item active">
                                <img src="/images/2.jpg" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide">
                            </div>
                        @endforelse

                    </div><!-- /.carousel-inner -->
                    <!-- スライドコントロールの設定 -->
                    <button type="button" class="carousel-control-prev" data-bs-target="#carouselWithControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">前へ</span>
                    </button>
                    <button type="button" class="carousel-control-next" data-bs-target="#carouselWithControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">次へ</span>
                    </button>
                </div>

                <h1 class="text-center my-5 fw-bold font-gray">{{ $site_masters->sales_copy}}</h1>
                <p class="text-center col-9 font-gray" style="margin:0 auto;">
                    {{ $site_masters->comment}}
                    </p>

                <div class="container mb-5">
                    <div class="d-flex row justify-content-evenly mt-5">
                        <div class="col-10 col-md-5">
                            <a role="botton" href="/search/goods" class="border btn btn-lg btn-color ms-2 mb-2 text-center fw-bold rounded-3 shadow-sm fs-4 w-100 d-flex flex-column"  style="font-size:40px;">
                            <img src="/images/bag.png" class="mx-auto my-3" style="width:60px">
                                <p class="mb-0 btn-text">名産品を買う</p>
                            </a>

                        </div>
                        <div class="col-10 col-md-5">
                            <a role="botton" href="/search/experience" class="border btn btn-lg btn-color m-2 mt-4 mt-md-0 text-center fw-bold rounded-3 shadow-sm fs-4 w-100 d-flex flex-column" style="font-size:40px;">
                                <img src="/images/active.png" class="mx-auto my-3" style="width:60px">
                                <p class="mb-0 btn-text">現地で遊ぶ</p>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
            <footer class="mt-4">
                <div class="bg-f-part py-3">
                    <h4 class="text-gray-color mb-0 ms-4 mt-4 fw-bold" style="padding-left:2rem">{{ $site_masters->site_name}}</h4>
                
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
                        <p class="text-gray-color ms-4 small" style="padding-left:2rem">Copyright© {{ $site_masters->site_name}} All rights reserved.</p>
                        <p class="text-gray-color ms-4 ms-md-0 me-md-4 mb-0 pb-3" style="padding-right:2rem;padding-left:2rem;"><small>Powered by  <img src="/images/rogo.png" alt="" style="width:140px"></small></p>
                    </div>
                </div>
            <footer>
        </div>
    </body>
</html>
