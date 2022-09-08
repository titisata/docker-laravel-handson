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
    width:500px;
    
}
.font-more-gray{
    color:#6f6e6f;
}
</style>
<div id="carouselWithControls" class="carousel slide" data-bs-ride="carousel">
    <!-- スライドさせる画像の設定 -->
    <div class="carousel-inner rounded-2">
        @forelse($images as $key=>$image)
            @if( $key == '1' )
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
<div class="container px-0" >
    <div class="row justify-content-center px-0" style="--bs-gutter-x: 0;">
        <div class="col-md-11 mt-4 px-0">
            <div class="text-center box-color p-4">
                <form action="/search/experience" method="get">
                @csrf
                    <div class="d-flex flex-column align-items-center">
                        <label for="keyword" class="fw-bold fs-5 mb-3">体験したい日とカテゴリーを入力してください</label>
                        <div class="d-lg-flex">
                            <input class="form-control me-lg-1" name="keyword" type="date" style="width:240px">
                            <select name="category" class="form-select ms-lg-1" style="width:216px">
                                <option value="">カテゴリ選択</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex m-2 ">
                            <div>
                                <input type="radio" name="loding">
                                <label for="">宿泊あり</label>
                            </div>
                            <div class="mx-4">
                                <input type="radio" name="loding">
                                <label for="">宿泊なし</label>
                            </div>
                            <div>
                                <input type="radio" name="loding">
                                <label for="">全て</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-sm btn-pink rounded-pill text-white my-2 btn-shadow fs-3 "><img src="/images/glass.png" alt="" style="width:32px;">検索</button>
                        
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
