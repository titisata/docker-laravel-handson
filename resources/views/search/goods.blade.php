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
            <img src="/storage/images/10.jpg" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide 1">
            <div class="carousel-caption d-sm-block w-100" style="right: 0;left: 0; bottom: 0;background: linear-gradient(rgba(0,0,0,0),rgb(226, 167, 4));">
                <h2 class="fw-bold mb-0">町で買い物しよう！！</h2>
            </div>
        </div>
        <div class="carousel-item">
            <img src="/storage/images/11.jpg" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide 2">
            <div class="carousel-caption  d-sm-block w-100" style="right: 0;left: 0; bottom: 0; background: linear-gradient(rgba(0,0,0,0),rgb(226, 167, 4));">
                <h2 class="fw-bold mb-0">町で買い物しよう！！</h2>
            </div>
        </div>
        <div class="carousel-item">
            <img src="/storage/images/12.jpg" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide 3">
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
<div class="container px-0">
    <div class="row justify-content-center px-0"style="--bs-gutter-x: 0;">
        <div class="col-md-10 mt-4 px-0">
            <div class="text-center">

                <h3 class="mb-3 fw-bold">検索するキーワードを入力してください</h3>
                <form class="mb-3 mt-3" action="/search/goods" method="get">
                    @csrf
                    <div class="d-flex flex-column align-items-center">
                        <input name="keyword" type="text" class="form-control" style="width:240px" placefolder="検索したいお土産を入力してください">
                        <select name="category" class="form-select mt-2" style="width:216px;">
                            <option value="">カテゴリ選択</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <input class="btn btn-secondary mt-3" style="width:180px" type="submit" value="検索">
                    </div>
                </form>
            </div>


            <h2 class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">おすすめの食べ物</h2>

            <ul class="horizontal-list">
                @foreach ($food_goods_folders as $goods_item_folder)
                    @include('components.goods_small_cell', ['goods_folder'=>$goods_item_folder])
                @endforeach
            </ul>


            <h2  class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">おすすめの飲み物</h2>

            <ul class="horizontal-list">
                @foreach ($drink_goods_folders as $goods_item_folder)
                    @include('components.goods_small_cell', ['goods_folder'=>$goods_item_folder])
                @endforeach
            </ul>


            <h2  class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">おすすめの雑貨</h2>

            <ul class="horizontal-list">
                @foreach ($goods_goods_folders as $goods_item_folder)
                    @include('components.goods_small_cell', ['goods_folder'=>$goods_item_folder])
                @endforeach
            </ul>


            <!-- <div class="mt-5">
                <a href="/search/experience">体験検索へ</a>
            </div> -->
        </div>
    </div>
</div>

@endsection
