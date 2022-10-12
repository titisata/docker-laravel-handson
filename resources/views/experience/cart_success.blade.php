@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-3">カートに入れました</h3>
            <a href="/search/experience">体験を予約する</a>
            <a href="/search/goods">お土産を見る</a>
            <a href="/cart">カートを見る</a>
            <a href="/home">ホームへ</a>
        </div>
    </div>
</div>

@endsection
