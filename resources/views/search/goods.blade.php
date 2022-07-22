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
.d-block{
    height:400px;
    object-fit: cover;

}
</style>
<div id="carouselWithCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <!-- スライドさせる画像の設定 -->
        <div class="carousel-inner rounded-2" >
            <div class="carousel-item active">
                <img src="/images/10.jpg" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide 1">
                <div class="carousel-caption d-sm-block w-100" style="right: 0;left: 0; bottom: 0;background: linear-gradient(rgba(0,0,0,0),rgb(226, 167, 4));">
                    <h2 class="fw-bold mb-0">町で買い物しよう！！</h2>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/images/11.jpg" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide 2">
                <div class="carousel-caption  d-sm-block w-100" style="right: 0;left: 0; bottom: 0; background: linear-gradient(rgba(0,0,0,0),rgb(226, 167, 4));">
                    <h2 class="fw-bold mb-0">町で買い物しよう！！</h2>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/images/12.jpg" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide 3">
                <div class="carousel-caption  d-sm-block w-100" style="right: 0;left: 0; bottom: 0; background: linear-gradient(rgba(0,0,0,0),rgb(226, 167, 4));">
                    <h2 class="fw-bold mb-0">町で買い物しよう！！</h2>
                </div>
            </div>      
        </div><!-- /.carousel-inner -->
        <!-- スライドコントロールの設定 -->
        <button type="button" class="carousel-control-prev" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">前へ</span>
        </button>
        <button type="button" class="carousel-control-next" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">次へ</span>
        </button>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mt-4">
            <div class="text-center">
                <form action="/search/goods" method="get">
                    <label for="keyword" class="fw-bold fs-5">検索するキーワードを入力してください</label>
                    <div class="d-flex justify-content-center mt-2">
                        <input class="form-control form-control-sm" name="keyword" type="text" style="width:240px">
                        <input type="submit" value="検索" class="btn btn-sm btn-secondary">
                    </div>
                </form>
            </div>


            <h2 class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">おすすめの食べ物</h2>
            <div class="d-flex justify-content-evenly">
                <ul class="horizontal-list">
                    @foreach ($food_goods_folders as $goods_item_folder)
                        @include('components.goods_small_cell', ['goods_folder'=>$goods_item_folder])
                    @endforeach
                </ul>    
            </div>

            <h2  class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">おすすめの飲み物</h2>
            <div class="d-flex justify-content-evenly">
                <ul class="horizontal-list">
                    @foreach ($drink_goods_folders as $goods_item_folder)
                        @include('components.goods_small_cell', ['goods_folder'=>$goods_item_folder])
                    @endforeach
                </ul>
            </div>

            <h2  class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">おすすめの雑貨</h2>
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
