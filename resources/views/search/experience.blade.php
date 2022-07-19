@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- <h1 class="mb-3">体験検索</h1> -->
            <div class="text-center">
                <form action="/search/experience" method="get">
                    <label for="keyword" class="fw-bold fs-5">体験したい日を入力してください</label><br>
                    <div class="d-flex justify-content-center mt-2">
                        <input class="form-control" name="keyword" type="date" style="width:240px">
                        <input type="submit" value="検索" class="btn btn-sm btn-secondary">
                    </div>
                    
                </form>
            </div>
            
            <h2 class="mt-5 ms-3 ms-md-0">おすすめの宿泊体験</h2>
            <div class="d-flex justify-content-evenly flex-wrap">
                @foreach ($experiences_folders_is_lodging as $experiences_folder)
                    @include('components.experience_small_cell', ['experienceFolder'=>$experiences_folder])
                @endforeach
            </div>

            <h2 class="mt-4 ms-3 ms-md-0">おすすめの体験</h2>
            <div class="d-flex justify-content-evenly flex-wrap">
                @foreach ($experiences_folders_not_is_lodging as $experiences_folder)
                    @include('components.experience_small_cell', ['experienceFolder'=>$experiences_folder])
                @endforeach
            </div>


            <!-- <div class="mt-5">
                <a href="/search/goods">土産検索へ</a>
            </div> -->
        </div>
    </div>
</div>

@endsection
