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
                    URATABI
                </a>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>

    </div>
</body>
</html>
