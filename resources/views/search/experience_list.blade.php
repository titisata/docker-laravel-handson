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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="ms-3 ms-md-0 mt-4">
                
                <div class="text-center">
                    <h3 class="mb-3 fw-bold">体験検索結果</h3>
                    <form action="/search/experience" method="get">
                    @csrf
                        <div class="d-flex flex-column align-items-center">
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
                
            </div>   
            

            <h2 class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">検索結果</h2>
            <div class="d-flex justify-content-evenly ">
                <ul class="horizontal-list">
                @forelse($experienceFolders as $experienceFolder)
                    @if (!$experienceFolder->is_holiday(app('request')->input('keyword')))
                        @include('components.experience_cell', ['experienceFolder'=>$experienceFolder])
                    @endif
                @empty
                    <p>検索結果がありません。</p>
                @endforelse
                </ul>
            </div>
            <!-- <a href="/search/goods">土産検索へ</a> -->
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <div>{{ $experienceFolders->appends(request()->query())->links('pagination::bootstrap-4') }}</div>
    </div>
</div>

@endsection
