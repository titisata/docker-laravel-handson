@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-3">検索結果</h3>

            <form action="/search/goods" method="get">
                <label for="keyword">ワード</label><input name="keyword" type="text">
            </form>

            @forelse($goods as $goods_one)
                @include('components.goods_cell', ['goods'=>$goods_one])
            @empty
                <p>検索結果がありません。</p>
            @endforelse
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <div>{{ $goods->appends(request()->query())->links('pagination::bootstrap-4') }}</div>
    </div>
</div>

@endsection
