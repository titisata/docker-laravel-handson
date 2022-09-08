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
<div id="carouselWithCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <!-- スライドさせる画像の設定 -->
        <div class="carousel-inner rounded-2" >
            <div class="carousel-item active">
                <img src="{{ $images->image_path  ?? '/images/2.jpg'}}" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide">
            </div>
        </div><!-- /.carousel-inner -->
</div>
<div class="container p-0">
    <div class="row justify-content-center" style="--bs-gutter-x: 0;">
        <div class="col-10 col-md-11 mt-4">
        <div class="text-center box-color p-4 rounded-4">
                <form class="mb-3 mt-3" action="/search/goods" method="get">
                    @csrf
                    <div class="d-flex flex-column align-items-center ">
                        <label for="keyword" class="fw-bold fs-5 mb-3">検索したいキーワードとカテゴリーを入力してください</label>
                        <div class="d-lg-flex mb-3">
                            <input name="keyword" type="text" class="form-control me-lg-1" style="width:240px" placefolder="検索したいお土産を入力してください" value="{{ app('request')->input('keyword') }}">
                            <select name="category" class="form-select ms-lg-1" style="width:216px">
                                <option value="">カテゴリ選択</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-sm btn-pink rounded-pill text-white my-2 btn-shadow fs-3"><img src="/images/glass.png" alt="" style="width:32px;">検索</button>
                        
                    </div>
                </form>
            </div>

        <h2 class="mt-5 ms-3 ms-md-0 fw-bold">検索結果</h2>
        <div class="d-flex justify-content-between flex-wrap">
            
        @forelse($goods_folders as $goods_folder)
            @include('components.goods_cell', ['goods_folder'=>$goods_folder])
        @empty
            <p>検索結果がありません。</p>
        @endforelse

        </div>
        
        <div class="d-flex justify-content-center mt-3">
            <div>{{ $goods_folders->appends(request()->query())->links('pagination::bootstrap-4') }}</div>
        </div>
</div>
    </div>
</div>

@endsection
