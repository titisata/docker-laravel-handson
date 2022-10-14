<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>URATABI</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'><link rel="stylesheet" href="./style.css">

        <!-- bootstrap5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- bootstrap icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        
        

    <script>
        $(document).ready(function(){
            var menu = document.getElementById("@yield('menu')");
            menu.classList.add("active");
        });
    </script>
    <style>
        body {
        margin-top: 50px;
        background-color: #fff;
        font-family: Arial, sans-serif;
        font-size: 14px;
        letter-spacing: 0.01em;
        color: #39464e;
        }

        .navbar-default {
        background-color: #FFF;
        margin-left: 200px;
        }

        .link {
        color: #0d6efd;
        text-decoration: underline;
        }

        .form{
        width:360px;
        }

        /*main side bar*/
        .msb {
        width: 200px;
        background-color: #F5F7F9;
        position: fixed;
        left: 0;
        top: 0;
        right: auto;
        min-height: 100%;
        overflow-y: auto;
        white-space: nowrap;
        height: 100%;
        z-index: 1;
        border-right: 1px solid #ddd;
        }
        .msb .navbar {
        border: none;
        margin-left: 0;
        background-color: inherit;
        }
        .msb .navbar-header {
        width: 100%;
        border-bottom: 1px solid #e7e7e7;
        margin-bottom: 20px;
        background: #fff;
        }
        .msb .navbar-nav .panel {
        border: 0 none;
        box-shadow: none;
        margin: 0;
        background: inherit;
        }
        .msb .navbar-nav li {
        display: block;
        width: 100%;
        }
        .msb .navbar-nav li a {
        padding: 15px;
        color: #5f5f5f;
        }
        .msb .navbar-nav li a .glyphicon, .msb .navbar-nav li a .fa {
        margin-right: 8px;
        }
        .msb .nb {
        padding-top: 5px;
        padding-left: 10px;
        margin-bottom: 30px;
        overflow: hidden;
        }

        ul.nv,
        ul.ns {
        position: relative;
        padding: 0;
        list-style: none;
        }

        .nv {
        /*ns: nav-sub*/
        }
        .nv li {
        display: block;
        position: relative;
        }
        .nv li::before {
        clear: both;
        content: "";
        display: table;
        }
        .nv li a {
        color: #444;
        padding: 10px 25px;
        display: block;
        vertical-align: middle;
        }
        .nv li a .ic {
        font-size: 16px;
        margin-right: 5px;
        font-weight: 300;
        display: inline-block;
        }
        .nv .ns li a {
        padding: 10px 50px;
        }

        /*main content wrapper*/
        .mcw {
        margin-left: 200px;
        position: relative;
        min-height: 100%;
        /*content view*/
        }
        /*globals*/
        a,
        a:focus,
        a:hover {
        text-decoration: none;
        }

        body.msb-x .mcw, body.msb-x .mnb {
        margin-left: 0;
        -moz-animation: bodyslideout 300ms forwards;
        -o-animation: bodyslideout 300ms forwards;
        -webkit-animation: bodyslideout 300ms forwards;
        animation: bodyslideout 300ms forwards;
        -webkit-transform-style: preserve-3d;
        transform-style: preserve-3d;
        }
        body.msb-x .msb {
        -moz-animation: slideout 300ms forwards;
        -o-animation: slideout 300ms forwards;
        -webkit-animation: slideout 300ms forwards;
        animation: slideout 300ms forwards;
        -webkit-transform-style: preserve-3d;
        transform-style: preserve-3d;
        }

        /* Slide in animation */
        @-moz-keyframes slidein {
        0% {
            left: -200px;
        }
        100% {
            left: 0;
        }
        }
        @-webkit-keyframes slidein {
        0% {
            left: -200px;
        }
        100% {
            left: 0;
        }
        }
        @keyframes slidein {
        0% {
            left: -200px;
        }
        100% {
            left: 0;
        }
        }
        @-moz-keyframes slideout {
        0% {
            left: 0;
        }
        100% {
            left: -200px;
        }
        }
        @-webkit-keyframes slideout {
        0% {
            left: 0;
        }
        100% {
            left: -200px;
        }
        }
        @keyframes slideout {
        0% {
            left: 0;
        }
        100% {
            left: -200px;
        }
        }
        @-moz-keyframes bodyslidein {
        0% {
            left: 0;
        }
        100% {
            margin-left: 200px;
        }
        }
        @-webkit-keyframes bodyslidein {
        0% {
            left: 0;
        }
        100% {
            left: 0;
        }
        }
        @keyframes bodyslidein {
        0% {
            margin-left: 0;
        }
        100% {
            margin-left: 200px;
        }
        }
        @-moz-keyframes bodyslideout {
        0% {
            margin-left: 200px;
        }
        100% {
            margin-right: 0;
        }
        }
        @-webkit-keyframes bodyslideout {
        0% {
            margin-left: 200px;
        }
        100% {
            margin-left: 0;
        }
        }
        @keyframes bodyslideout {
        0% {
            margin-left: 200px;
        }
        100% {
            margin-left: 0;
        }
        }
        
    </style>
</head>
<body>
<!-- partial:index.partial.html -->
<nav class="mnb navbar navbar-default navbar-fixed-top" style="height: 40px">
  <div class="container">
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li>
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-gray-color fw-bold me-5" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="position:absolute">
                @role('system_admin|site_admin')
                    <a class="dropdown-item" href="{{ url('/mypage/owner/') }}">マイページ</a>
                @endrole 
                @role('partner')
                    <a class="dropdown-item" href="{{ url('/mypage/partner/') }}">マイページ</a>
                @endrole
                @role('user')
                    <a class="dropdown-item" href="{{ url('/mypage/user/') }}">マイページ</a>
                @endrole 
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
        
      </ul>
    </div>
  </div>
</nav>
<div class="msb">
		<nav class="navbar navbar-default" role="navigation">
			<div class="navbar-header">
				<div class="brand-wrapper">
					<div class="brand-name-wrapper text-center">
						<a class="navbar-brand" href="/">
							URATABI
						</a>
					</div>

				</div>

			</div>

			<!-- Main Menu -->
			<div class="side-menu-container">
				<ul class="nav navbar-nav">
                @role('system_admin|site_admin')
                    <li ><a href="/mypage/partner"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>ホーム</a></li>
                    <li ><a href="/mypage/owner/site"><span class="glyphicon glyphicon-signal"></span>サイト管理</a></li>
					<li><a href="/mypage/owner/users"><i class="fa fa-dashboard"></i>ユーザー管理</a></li>
                    <li><a href="/mypage/owner/partner_display"><i class="fa fa-heart"></i>出展者管理</a></li>
                    <li><a href="/mypage/partner/event"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span>イベント管理</a></li>
                    <li><a href="/mypage/partner/goods"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>名産品管理</a></li>
                    <li><a href="/mypage/partner/reserve"><i class="fa fa-puzzle-piece"></i>イベント予約一覧</a></li>
                    <li><a href="/mypage/partner/goods_reserve"><i class="fa fa-puzzle-piece"></i>名産品注文履歴一覧</a></li>
                    <li><a href="/mypage/owner/link_display"><i class="fa fa-dashboard"></i>必須表示ページ管理</a></li>
                    <li><a href="/mypage/owner/category_display"><span class="glyphicon glyphicon-signal"></span>カテゴリー編集</a></li>
                    <li><a href="/mypage/owner/hotel_group_display"><span class="glyphicon glyphicon-signal"></span>ホテルグループ編集</a></li>
                    <li><a href="/mypage/owner/hotel_display"><span class="glyphicon glyphicon-signal"></span>ホテル編集</a></li>
                    <li><a href="/mypage/owner/food_group_display"><span class="glyphicon glyphicon-signal"></span>フードグループ編集</a></li>
                    <li><a href="/mypage/owner/food_display"><span class="glyphicon glyphicon-signal"></span>フード編集</a></li>
                    <li><a href="/mypage/owner/sales_result"><span class="glyphicon glyphicon-signal"></span>売り上げ実績</a></li>
                    
                @endrole
                @role('partner')
                    <li><a href="/mypage/partner"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>ホーム</a></li>
                    <li><a href="/mypage/partner/reserved_user"><i class="fa fa-puzzle-piece"></i>ユーザー管理</a></li>
                    <li><a href="/users_account"><i class="fa fa-puzzle-piece"></i>アカウント管理</a></li>
                    <li><a href="/mypage/partner/profile"><i class="fa fa-puzzle-piece"></i>出展者プロフィール管理</a></li>
                    <li><a href="/mypage/partner/event"><i class="fa fa-puzzle-piece"></i>イベント管理</a></li>
                    <li><a href="/mypage/partner/goods"><i class="fa fa-puzzle-piece"></i>名産品管理</a></li>
                    <li><a href="/mypage/partner/reserve"><i class="fa fa-puzzle-piece"></i>イベント予約一覧</a></li>
                    <li><a href="/mypage/partner/goods_reserve"><i class="fa fa-puzzle-piece"></i>名産品注文履歴一覧</a></li>
                    <li><a href="/mypage/partner/link_display"><i class="fa fa-dashboard"></i>必須表示ページ管理</a></li>
                    
                @endrole
                @role('user')
                    <li><a href="/mypage/user"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>ホーム</a></li>
                    <li><a href="/users_account"><i class="fa fa-puzzle-piece"></i>アカウント管理</a></li>
                    <li><a href="/mypage/user/favorite"><i class="fa fa-puzzle-piece"></i>お気に入り一覧</a></li>
                    <li class="mt-5"><a href="/"><span class="glyphicon glyphicon-signal"></span>ユーザーページへ</a></li>
                @endrole    
             
					<!-- Dropdown-->
					{{-- <li class="panel panel-default" id="dropdown">
						<a data-toggle="collapse" href="#dropdown-lvl1">
							<i class="fa fa-diamond"></i> イベント
						  <span class="caret"></span>
                        </a>
						<!-- Dropdown level 1 -->
						<div id="dropdown-lvl1" class="panel-collapse collapse">
							<div class="panel-body">
								<ul class="nav navbar-nav">
									<li><a href="#">Mail</a></li>
									<li><a href="#">Calendar</a></li>
									<li><a href="#">Ecommerce</a></li>
									<li><a href="#">User</a></li>
									<li><a href="#">Social</a></li>

									<!-- Dropdown level 2 -->
									<li class="panel panel-default" id="dropdown">
										<a data-toggle="collapse" href="#dropdown-lvl2">
											<i class="glyphicon glyphicon-off"></i> Sub Level <span class="caret"></span>
										</a>
										<div id="dropdown-lvl2" class="panel-collapse collapse">
											<div class="panel-body">
												<ul class="nav navbar-nav">
													<li><a href="#">Link</a></li>
													<li><a href="#">Link</a></li>
													<li><a href="#">Link</a></li>
												</ul>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</li> --}}
				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>
</div>
<!--main content wrapper-->
<div class="mcw">
  <!--navigation here-->
  <!--main content view-->
  <div class="cv">
    <div>
     <div class="inbox">
       <div class="inbox-sb">

       </div>
       <div class="inbox-bx container-fluid">
         <div class="">
            <main class="">
                @yield('content')
            </main>
         </div>
       </div>
     </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
