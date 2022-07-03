@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-3">{{ $goods->name }}</h3>
            <div class="card">
                <div class="card-header">詳細</div>
                <div class="card-body">
                    <p>名前: {{ $goods->name }}</p>
                    <p>値段: {{ $goods->price }}円</p>
                    <p>説明: {{ $goods->description }}</p>
                    <form class="mb-3 mt-3" action="{{ Request::url() }}" method="POST">
                        @csrf
                        <label for="quantity">個数</label><input name="quantity" type="number">
                        <input type="submit" class="btn btn-primary" href="">カートに入れる</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
