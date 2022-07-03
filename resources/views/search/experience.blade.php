@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-3">体験検索</h3>
            <form action="/search/experience" method="get">
                <label for="keyword">日付</label><input name="keyword" type="date">
                <input type="submit" value="検索">
            </form>
            <div class="mt-5">
                <a href="/search/goods">土産検索へ</a>
            </div>
        </div>
    </div>
</div>

@endsection
