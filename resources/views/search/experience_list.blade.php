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
    color:#494645;
}
   
</style>
<div id="carouselWithCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <!-- スライドさせる画像の設定 -->
        <div class="carousel-inner rounded-2" >
            @forelse($images as $image)
                <div class="carousel-item active">
                    <img src="{{ $image->image_path }}" class="d-block w-100 mx-auto" data-bs-interval="300" alt="Slide">
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
    <div class="row justify-content-center"style="--bs-gutter-x: 0;">
        <div class="col-11 col-md-11">

            <div class="ms-3 ms-md-0 mt-4">
                
                <div class="text-center box-color p-4">
                    <form action="/search/experience" method="get">
                    @csrf
                        <div class="d-flex flex-column align-items-center">
                            <div class="d-lg-flex">
                                <input class="form-control me-lg-1" name="keyword" type="date" style="width:240px">     
                                <select name="category" class="form-select ms-lg-1" style="width:216px">
                                    <option value="">カテゴリ選択</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            
                            <div class="d-flex m-2">
                                <div>
                                    <input type="radio" name="loding">
                                    <label for="">宿泊あり</label>
                                </div>
                                <div>
                                    <input type="radio" name="loding">
                                    <label for="">宿泊なし</label>
                                </div>
                                <div>
                                    <input type="radio" name="loding">
                                    <label for="">全て</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-pink rounded-pill text-white my-2 btn-shadow fs-3"><img src="" alt="">検索</button>
                        </div>
                        
                    </form>
                </div>
                
            </div>   
            

            <h2 class="mt-5 ms-3 ms-md-0 fw-bold">検索結果</h2>
            <div class="d-flex justify-content-between flex-wrap">
                
                @forelse($experienceFolders as $experienceFolder)
                    @if (!$experienceFolder->is_holiday(app('request')->input('keyword')))
                        @include('components.experience_cell', ['experienceFolder'=>$experienceFolder])
                    @endif
                @empty
                    <p>検索結果がありません。</p>
                @endforelse
                
            </div>
            <!-- <a href="/search/goods">土産検索へ</a> -->
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <div>{{ $experienceFolders->appends(request()->query())->links('pagination::bootstrap-4') }}</div>
    </div>
</div>

@endsection
