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
.box-color{
    background-color:#f4f4f4;
}
.btn-pink{
    background-color:#FB6E86;
    border-color:#FB6E86;
    width:400px;
    
}
.font-gray{
                color:#848283;
}
.font-more-gray{
    color:#6f6e6f;
}
</style>
<div id="carouselWithControls" class="carousel slide" data-bs-ride="carousel">
    <!-- スライドさせる画像の設定 -->
    <div class="carousel-inner rounded-2">
        @forelse($images as $key=>$image)
            @if( $key == '0' )
                <div class="carousel-item active">
                    <img src="{{ $image->image_path }}" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide {{$key+1}}">
                </div>
            @else
                <div class="carousel-item">
                    <img src="{{ $image->image_path }}" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide {{$key+1}}">
                </div>
            @endif
        @empty
            <div class="carousel-item active">
                <img src="/images/2.jpg" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide">
            </div>
        @endforelse

    </div><!-- /.carousel-inner -->
    <!-- スライドコントロールの設定 -->
    <button type="button" class="carousel-control-prev" data-bs-target="#carouselWithControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">前へ</span>
    </button>
    <button type="button" class="carousel-control-next" data-bs-target="#carouselWithControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">次へ</span>
    </button>
</div>
<div class="container px-0">
    <div class="row justify-content-center px-0"style="--bs-gutter-x: 0;">
        <div class="col-md-11 mt-4 px-0">
            <div class="text-center box-color p-4 rounded-4">

                <form class="mb-3 mt-3" action="/search/goods" method="get">
                    @csrf
                    <div class="d-flex flex-column align-items-center ">
                        <label for="keyword" class="fw-bold fs-5 mb-3">検索したいキーワードとカテゴリーを入力してください</label>
                        <div class="d-lg-flex mb-3">
                            <input name="keyword" type="text" class="form-control me-lg-1" style="width:240px" placeholder="検索したいキーワードを入力" value="">
                            <select name="category" class="form-select ms-lg-1" style="width:216px">
                                <option value="">カテゴリ選択</option>
                                @foreach ($categories as $one_category)
                                    <option value="{{ $one_category->name }}">{{ $one_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-sm btn-pink rounded-pill text-white my-2 btn-shadow fs-3"><img src="/images/glass.png" alt="" style="width:32px;">検索</button>
                        
                    </div>
                </form>
            </div>

            <?php $item_count=0; ?>
            @foreach ($categories as $category)
                @if($goods_folders[$item_count] != '[]')
                    <h2 class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">おすすめの{{ $category->name }}</h2>

                    <ul class="horizontal-list">
                        @foreach ($goods_folders[$item_count] as $goods_item_folder)
                            @include('components.goods_small_cell', ['goods_folder'=>$goods_item_folder])
                        @endforeach
                    </ul>
                @endif    
            <?php $item_count++; ?>
            @endforeach

  
            
        </div>
    </div>
</div>

@endsection
