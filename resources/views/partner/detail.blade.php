@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">パートナー詳細ページ</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>パートナー画像</p>
                    <img src="{{ $partner->images()[0]?->image_path ?? '/images/empty.png'}}" alt="">
                    <p>名前: {{ $partner->name }}</p>
                    <p>住所: {{ $partner->address }}</p>
                    <p>電話番号: {{ $partner->phone }}</p>
                    <p>キャッチコピー: {{ $partner->catch_copy }}</p>
                </div>
            </div>

            <h2 class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">体験</h2>
            <div class="d-flex justify-content-evenly flex-wrap">
                <ul class="horizontal-list">
                    @foreach ($experience_folders as $experience_folder)
                        @include('components.experience_small_cell', ['experienceFolder'=>$experience_folder])
                    @endforeach
                </ul>
            </div>

            <h2 class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">お土産</h2>
            <div class="d-flex justify-content-evenly flex-wrap">
                <ul class="horizontal-list">
                    @foreach ($goods_folders as $goods_folder)
                        @include('components.goods_small_cell', ['goods_folder'=>$goods_folder])
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
