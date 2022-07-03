@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-3">土産検索</h3>
            <form action="/search/goods" method="get">
                <label for="keyword">検索ワード</label><input name="keyword" type="text">
                <input type="submit" value="検索">
            </form>
            <div class="mt-5">
                <a href="/search/experience">体験検索へ</a>
            </div>
        </div>
    </div>
</div>

@endsection
