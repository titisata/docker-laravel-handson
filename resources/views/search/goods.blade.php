@extends('layouts.app')

@section('content')
<style>
    ul.horizontal-list {
	overflow-x: auto;
	white-space: nowrap;
}
li.item {
	display: inline-block;
}	
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-center">
                <form action="/search/goods" method="get">
                    <label for="keyword" class="fw-bold fs-5">検索するキーワードを入力してください</label>
                    <div class="d-flex justify-content-center mt-2">
                        <input class="form-control form-control-sm" name="keyword" type="text" style="width:240px">
                        <input type="submit" value="検索" class="btn btn-sm btn-secondary">
                    </div>
                </form>
            </div>


            <h2 class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">おすすめのお土産 (食べ物)</h2>
            <div class="d-flex justify-content-evenly">
                <ul class="horizontal-list">
                    @foreach ($food_goods_folders as $goods_item_folder)
                        @include('components.goods_small_cell', ['goods_folder'=>$goods_item_folder])
                    @endforeach
                </ul>    
            </div>

            <h2  class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">おすすめのお土産 (飲み物)</h2>
            <div class="d-flex justify-content-evenly">
                <ul class="horizontal-list">
                    @foreach ($drink_goods_folders as $goods_item_folder)
                        @include('components.goods_small_cell', ['goods_folder'=>$goods_item_folder])
                    @endforeach
                </ul>
            </div>

            <h2  class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">おすすめのお土産 (雑貨)</h2>
            <div class="d-flex justify-content-evenly flex-wrap">
                <ul class="horizontal-list">
                    @foreach ($goods_goods_folders as $goods_item_folder)
                        @include('components.goods_small_cell', ['goods_folder'=>$goods_item_folder])
                    @endforeach
                </ul>
            </div>

            <!-- <div class="mt-5">
                <a href="/search/experience">体験検索へ</a>
            </div> -->
        </div>
    </div>
</div>

@endsection
