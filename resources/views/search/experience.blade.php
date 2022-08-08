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
                <img src="/images/9.jpg" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide 1">
                <div class="carousel-caption d-sm-block w-100" style="right: 0;left: 0; bottom: 0;background: linear-gradient(rgba(0,0,0,0),rgb(125, 209, 52));">
                    <h2 class="fw-bold mb-0">○○町で体験しよう！！</h2>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/images/2.jpg" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide 2">
                <div class="carousel-caption  d-sm-block w-100" style="right: 0;left: 0; bottom: 0; background: linear-gradient(rgba(0,0,0,0),rgb(125, 209, 52));">
                    <h2 class="fw-bold mb-0">○○町で体験しよう！！</h2>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/images/3.jpg" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide 3">
                <div class="carousel-caption  d-sm-block w-100" style="right: 0;left: 0; bottom: 0; background: linear-gradient(rgba(0,0,0,0),rgb(125, 209, 52));">
                    <h2 class="fw-bold mb-0">○○町で体験しよう！！</h2>
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
<div class="container px-0" >

    <div class="row justify-content-center px-0" style="--bs-gutter-x: 0;">
        <div class="col-md-10 mt-4 px-0">
            <div class="text-center">
                <form action="/search/experience" method="get">
                @csrf
                    <div class="d-flex flex-column align-items-center">
                        <label for="keyword" class="fw-bold fs-5">体験したい日を入力してください</label>
                        <input class="form-control" name="keyword" type="date" style="width:240px">
                        <select name="category" class="form-select mt-2" style="width:216px">
                            <option value="">カテゴリ選択</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="検索" class="btn btn btn-secondary mt-3" style="width:180px">
                    </div>

                </form>
            </div>

            <h2 class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">おすすめの宿泊体験</h2>

            <ul class="horizontal-list ps-0" >
                @foreach ($experiences_folders_is_lodging as $experiences_folder)
                    @include('components.experience_small_cell', ['experienceFolder'=>$experiences_folder])
                @endforeach
            </ul>


            <h2 class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">おすすめの体験</h2>

            <ul class="horizontal-list">
                @foreach ($experiences_folders_not_is_lodging as $experiences_folder)
                    @include('components.experience_small_cell', ['experienceFolder'=>$experiences_folder])
                @endforeach
            </ul>



            <!-- <div class="mt-5">
                <a href="/search/goods">土産検索へ</a>
            </div> -->
        </div>
    </div>
</div>

@endsection
