@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">体験検索</div>
                <div class="card-body">
                    <form action="/search/experience" method="get">
                        <label for="keyword">ワード</label><input name="keyword" type="text">
                    </form>
                </div>
            </div>
            <a href="/search/goods">土産検索へ</a>
        </div>
    </div>
</div>

@endsection
