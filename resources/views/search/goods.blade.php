@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">土産検索</div>
                <div class="card-body">
                    <form action="/search/goods" method="get">
                        <label for="keyword">ワード</label><input name="keyword" type="text">
                    </form>
                </div>
            </div>
            <a href="/search/experience">体験検索へ</a>
        </div>
    </div>
</div>

@endsection
