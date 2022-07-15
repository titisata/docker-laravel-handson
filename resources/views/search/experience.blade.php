@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-3">体験検索</h3>
            <form action="/search/experience" method="get">
                <label for="keyword">日付</label><input name="keyword" type="date">
                <input type="submit" value="検索">
            </form>

            <h2>おすすめの宿泊体験</h2>
            <div class="d-flex justify-content-evenly flex-wrap">
                @foreach ($experiences_folders_is_lodging as $experiences_folder)
                    @include('components.experience_small_cell', ['experinceFolder'=>$experiences_folder])
                @endforeach
            </div>

            <h2>おすすめの体験</h2>
            <div class="d-flex justify-content-evenly flex-wrap">
                @foreach ($experiences_folders_not_is_lodging as $experiences_folder)
                    @include('components.experience_small_cell', ['experinceFolder'=>$experiences_folder])
                @endforeach
            </div>
            

            <div class="mt-5">
                <a href="/search/goods">土産検索へ</a>
            </div>
        </div>
    </div>
</div>

@endsection
