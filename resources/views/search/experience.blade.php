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
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-center">
                <form action="/search/experience" method="get">
                    <label for="keyword" class="fw-bold fs-5">体験したい日を入力してください</label><br>
                    <div class="d-flex justify-content-center mt-2">
                        <input class="form-control" name="keyword" type="date" style="width:240px">
                        <input type="submit" value="検索" class="btn btn-sm btn-secondary">
                    </div>
                    
                </form>
            </div>
            
            <h2 class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">おすすめの宿泊体験</h2>
            <div class="" >
                <ul class="horizontal-list">
                    @foreach ($experiences_folders_is_lodging as $experiences_folder)
                        @include('components.experience_small_cell', ['experienceFolder'=>$experiences_folder])
                    @endforeach
                </ul>
            </div>

            <h2 class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">おすすめの体験</h2>
            <div class="">
                <ul class="horizontal-list">
                    @foreach ($experiences_folders_not_is_lodging as $experiences_folder)
                        @include('components.experience_small_cell', ['experienceFolder'=>$experiences_folder])
                    @endforeach
                </ul>    
            </div>


            <!-- <div class="mt-5">
                <a href="/search/goods">土産検索へ</a>
            </div> -->
        </div>
    </div>
</div>

@endsection
