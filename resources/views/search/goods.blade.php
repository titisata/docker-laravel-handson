@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">

            <!-- <h3 class="mb-3">土産検索</h3> -->
            <div class="text-center">
                <form action="/search/goods" method="get">
                    <label for="keyword" class="fw-bold fs-5">検索するキーワードを入力してください</label>
                    <div class="d-flex justify-content-center mt-2">
                        <input class="form-control form-control-sm" name="keyword" type="text" style="width:240px">
                        <input type="submit" value="検索" class="btn btn-sm btn-secondary">
                    </div>
                </form>
            </div>


            <h2 class="mt-5">おすすめのお土産 (食べ物)</h2>
            <div class="d-flex justify-content-evenly flex-wrap">
                @foreach ($food_goods as $goods_item)
                    @include('components.goods_small_cell', ['goods'=>$goods_item])
                @endforeach
            </div>

            <h2 class="mt-4">おすすめのお土産 (飲み物)</h2>
            <div class="d-flex justify-content-evenly flex-wrap">
                @foreach ($drink_goods as $goods_item)
                    @include('components.goods_small_cell', ['goods'=>$goods_item])
                @endforeach
            </div>

            <h2 class="mt-4">おすすめのお土産 (雑貨)</h2>
            <div class="d-flex justify-content-evenly flex-wrap">
                @foreach ($goods_goods as $goods_item)
                    @include('components.goods_small_cell', ['goods'=>$goods_item])
                @endforeach
            </div>

            <!-- <div class="mt-5">
                <a href="/search/experience">体験検索へ</a>
            </div> -->
        </div>
    </div>
</div>

@endsection
