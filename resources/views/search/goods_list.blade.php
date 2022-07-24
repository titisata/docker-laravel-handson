@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-3">{{ app('request')->input('keyword') }}の土産検索結果</h3>


            <form class="mb-3 mt-3" action="/search/goods" method="get">
            @csrf
                <label for="keyword">ワード</label><input name="keyword" type="text" value="{{ app('request')->input('keyword') }}">
                <select name="category">
                    <option value="">カテゴリ選択</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <input type="submit" value="検索">
            </form>

            @forelse($goods_folders as $goods_folder)
                @include('components.goods_cell', ['goods_folder'=>$goods_folder])
            @empty
                <p>検索結果がありません。</p>
            @endforelse
            <a href="/search/experience">体験検索へ</a>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <div>{{ $goods_folders->appends(request()->query())->links('pagination::bootstrap-4') }}</div>
    </div>
</div>

@endsection
