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
            .logo{
                width:320px;
            }
            ul.horizontal-list {
                overflow-x: auto;
                white-space: nowrap;
            }
            li.item {
                display: inline-block;
            }
            
            .box-color{
                background-color:#f4f4f4;
            }
            .font-gray{
                            color:#848283;
            }
            .font-more-gray{
                color:#6f6e6f;
            }
        </style>
    </head>
    <body class="bg-light">
        <div>
            <nav class="navbar navbar-expand-md navbar-light shadow-sm bg-dark d-flex align-items-center justify-content-between">
                <!-- <div class="d-flex align-items-center justify-content-between"> -->
                <div class="container-fluid">
                    <a class="navbar-brand  text-gray-color" href="">
                        <img src="/images/logo_sample.png" alt="" class="ms-4 logo" >
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

            <div class="">

            <div id="carouselWithControls" class="carousel slide" data-bs-ride="carousel">
                    <!-- スライドさせる画像の設定 -->
                    <div class="carousel-inner rounded-2">
                        <div class="carousel-item active">
                            <img src="/images/top_sample.jpg" class="d-block w-100 mx-auto" data-bs-interval="300">
                        </div>
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

                <div class='container row mt-4 mx-auto'>
                    <div class='left_menu col-3'>
                        <div class='category_box bg-white py-3'>
                            <p class='ms-4 h4'>カテゴリー</p>
                            <ul>
                                <li class='my-2'>
                                    <button class="btn-link text-dark bg-white text-decoration-none dropdown-toggle collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseitem" aria-expanded="false" aria-controls="collapseitem">
                                        アイテム
                                    </button>
                                    <div class="collapse" id="collapseitem">
                                        <div class="">
                                            <ul>
                                                <li class='my-1'>
                                                    <a href="#">作業服</a>
                                                </li>
                                                <li class='my-1'>
                                                    <a href="#">つなぎ</a>
                                                </li>
                                                <li class='my-1'>
                                                    <a href="#">安全靴</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class='my-2'>
                                    <button class="btn-link text-dark bg-white text-decoration-none dropdown-toggle collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsebrand" aria-expanded="false" aria-controls="collapsebrand">
                                        ブランド
                                    </button>
                                    <div class="collapse" id="collapsebrand">
                                        <div class="">
                                            <ul>
                                                <li class='my-1'>
                                                    <a href="#">～ワーク</a>
                                                </li>
                                                <li class='my-1'>
                                                    <a href="#">～ワーク</a>
                                                </li>
                                                <li class='my-1'>
                                                    <a href="#">～ワーク</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class='my-2'>
                                    <button class="btn-link text-dark bg-white text-decoration-none dropdown-toggle collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseseason" aria-expanded="false" aria-controls="collapseseason">
                                        季節商品
                                    </button>
                                    <div class="collapse" id="collapseseason">
                                        <div class="">
                                            <ul>
                                                <li class='my-1'>
                                                    <a href="#">夏物</a>
                                                </li>
                                                <li class='my-1'>
                                                    <a href="#">冬物</a>
                                                </li>
                                                <li class='my-1'>
                                                    <a href="#">時期物</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class='my-2'>
                                    <button class="btn-link text-dark bg-white text-decoration-none dropdown-toggle collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsework" aria-expanded="false" aria-controls="collapsework">
                                        業種別
                                    </button>
                                    <div class="collapse" id="collapsework">
                                        <div class="">
                                            <ul>
                                                <li class='my-1'>
                                                    <a href="#">建設・建築</a>
                                                </li>
                                                <li class='my-1'>
                                                    <a href="#">電気・設備</a>
                                                </li>
                                                <li class='my-1'>
                                                    <a href="#">農作業</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class='my-2'>
                                    <button class="btn-link text-dark bg-white text-decoration-none dropdown-toggle collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsemens" aria-expanded="false" aria-controls="collapsemens">
                                        メンズ
                                    </button>
                                    <div class="collapse" id="collapsemens">
                                        <div class="">
                                            <ul>
                                                <li class='my-1'>
                                                    <a href="#">作業服</a>
                                                </li>
                                                <li class='my-1'>
                                                    <a href="#">つなぎ</a>
                                                </li>
                                                <li class='my-1'>
                                                    <a href="#">安全靴</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class='my-2'>
                                    <button class="btn-link text-dark bg-white text-decoration-none dropdown-toggle collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapselady" aria-expanded="false" aria-controls="collapselady">
                                        レディース
                                    </button>
                                    <div class="collapse" id="collapselady">
                                        <div class="">
                                            <ul>
                                                <li class='my-1'>
                                                    <a href="#">作業服</a>
                                                </li>
                                                <li class='my-1'>
                                                    <a href="#">つなぎ</a>
                                                </li>
                                                <li class='my-1'>
                                                    <a href="#">安全靴</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class='main_content offset-sm col-set bg-white'>
                        <div class='category container-fluid'>
                            <div class='row mt-3'>
                                <div class='col'>
                                    <a href="/search/goods">
                                        <button class='btn btn-light w-100 py-3 shadow-sm'>
                                            アイテム
                                        </button>
                                    </a>
                                </div>
                                <div class='col'>
                                    <a href="">
                                        <button class='btn btn-light w-100 py-3 shadow-sm'>
                                            ブランド
                                        </button>
                                    </a>
                                </div>
                                <div class='col'>
                                    <a href="">
                                        <button class='btn btn-light w-100 py-3 shadow-sm'>
                                            季節商品
                                        </button>
                                    </a>
                                </div>

                            </div>
                            <div  class='row mt-3'>
                                <div class='col'>
                                    <a href="">
                                        <button class='btn btn-light w-100 py-3 shadow-sm'>
                                            業種別
                                        </button>
                                    </a>
                                </div>
                                <div class='col'>
                                    <a href="">
                                        <button class='btn btn-light w-100 py-3 shadow-sm'>
                                            メンズ
                                        </button>
                                    </a>
                                </div>
                                <div class='col'>
                                    <a href="">
                                        <button class='btn btn-light w-100 py-3 shadow-sm'>
                                            レディース
                                        </button>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class='border-top mt-4 py-4'>
                            <!-- <div class='card mt-3'> -->
                                <!-- <div class='p-2 d-flex align-items-end'>
                                    <p class='mb-0 h4'>おすすめアイテム</p>
                                    <a href="#" class='ms-4 text-primary text-decoration-underline'>もっと見る</a>
                                </div>
                                
                                <ul style='overflow-x: auto;white-space: nowrap;'>

                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>

                                </ul> -->
                                <?php $item_count=0; ?>
                                @foreach ($categories as $category)
                                    @if($goods_folders[$item_count] != '[]')
                                    <div class='card mt-3'>
                                        <h3 class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">おすすめの{{ $category->name }}</h3>

                                        <ul class="horizontal-list">
                                            @foreach ($goods_folders[$item_count] as $goods_item_folder)
                                                @include('components.goods_small_cell', ['goods_folder'=>$goods_item_folder])
                                            @endforeach
                                        </ul>
                                    </div>    
                                    @endif    
                                <?php $item_count++; ?>
                                @endforeach

                            <!-- </div> -->

                            <div class='card mt-3'>
                                <div class='p-2 d-flex align-items-end'>
                                    <p class='mb-0 h4'>ブランド別</p>
                                    <a href="#" class='ms-4 text-primary text-decoration-underline'>もっと見る</a>
                                </div>
                                
                                <ul style='overflow-x: auto;white-space: nowrap;'>

                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>

                                </ul>

                            </div>

                            <div class='card mt-3'>
                                <div class='p-2 d-flex align-items-end'>
                                    <p class='mb-0 h4'>ブランド別</p>
                                    <a href="#" class='ms-4 text-primary text-decoration-underline'>もっと見る</a>
                                </div>
                                
                                <ul style='overflow-x: auto;white-space: nowrap;'>

                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>

                                </ul>

                            </div>

                            <div class='card mt-3'>
                                <div class='p-2 d-flex align-items-end'>
                                    <p class='mb-0 h4'>ブランド別</p>
                                    <a href="#" class='ms-4 text-primary text-decoration-underline'>もっと見る</a>
                                </div>
                                
                                <ul style='overflow-x: auto;white-space: nowrap;'>

                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>
                                    <li style='display: inline-block;'>
                                        <a href="#">    
                                            <div class='card cell mb-3'>
                                                <img src="/images/dickeys.jpg" alt="">
                                                <p class='small text-center mb-1'>Dickies</p>
                                            </div>
                                        </a>    
                                    </li>

                                </ul>

                            </div>
                            

                        </div>

                    </div>

                </div>
                

                
            </div>
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
