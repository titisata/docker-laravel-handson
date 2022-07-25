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
    <div class="row justify-content-center" style="--bs-gutter-x: 0;">
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

@endsection
