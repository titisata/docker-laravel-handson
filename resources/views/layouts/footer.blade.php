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
        .pink{
            background-color:rgb(242, 118, 105);
            border-color:rgb(242, 118, 105);
        }
    </style>
</head>
<body>
@extends('layouts.app')
    <footer>
        <div class = "bg-secondary">
            <h4>観光協会</h4>
        </div>
        <div class = "pink">
            <div class="d-flex">
                <div class="d-flex flex-column">
                    <ul>
                        <li><a href="#" class="text-white">プログラム一覧</a></li>
                        <li><a href="#" class="text-white">商品一覧</a></li>
                        <li><a href="#" class="text-white">支払い方法</a></li>
                    </ul>
                </div>
                <div class="d-flex flex-column">
                    <ul>
                        <li><a href="#" class="text-white">キャンセル・返品について</a></li>
                        <li><a href="#" class="text-white">特定商取引に基づく表記</a></li>
                        <li><a href="#" class="text-white"></a>プライバシーポリシー</li>
                    </ul>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <p class="text-white">Copyright© 観光協会 All rights reserved.</p>
                <p class="text-white"><small>Powered by URATABI</small></p>
            </div>
        </div>
        
        

        
    <footer>
</body>
</html>
