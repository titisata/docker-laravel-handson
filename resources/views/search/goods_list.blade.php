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
            @forelse($images as $image)
                <div class="carousel-item active">
                    <img src="{{ $image->image_path }}" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide {{ $image->id }}">
                </div>
            @empty
                <div class="carousel-item active">
                    <img src="/images/2.jpg" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide 1">
                </div>
            @endforelse
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
<div class="container p-0">
    <div class="row justify-content-center" style="--bs-gutter-x: 0;">
        <div class="col-10 col-md-10">
        <div class="ms-3 ms-md-0 mt-4">
            <div class="text-center">
                <h3 class="mb-3 fw-bold">{{ app('request')->input('keyword') }}の土産検索結果</h3>
                <form class="mb-3 mt-3" action="/search/goods" method="get">
                    @csrf
                    <div class="d-flex flex-column align-items-center">
                        <input name="keyword" type="text" class="form-control" style="width:240px" placefolder="検索したいお土産を入力してください" value="{{ app('request')->input('keyword') }}">
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
        </div>

        <h2 class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">検索結果</h2>
            
        @forelse($goods_folders as $goods_folder)
            @include('components.goods_cell', ['goods_folder'=>$goods_folder])
        @empty
            <p>検索結果がありません。</p>
        @endforelse
        
        
            
    
        <div class="d-flex justify-content-center mt-3">
            <div>{{ $goods_folders->appends(request()->query())->links('pagination::bootstrap-4') }}</div>
        </div>
</div>
    </div>
</div>

@endsection
