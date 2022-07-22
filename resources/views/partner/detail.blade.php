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

            <div class="mt-5">
                <h3 class="border-bottom fw-bold pb-3">{{ $partner->name }}</h3>
                <div class="">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4 class="fw-bold pt-3">会社紹介</h4>
                    <p>{{ $partner->description }}</p>

                    <div>
                        <img class="w-100" src="{{ $partner->images()[0]?->image_path ?? '/images/empty.png'}}" style="height:400px;object-fit: cover;" alt="">
                    </div>
                    <h4 class="fw-bold pt-4">アクセス</h4>
                    <p>{{ $partner->access }}</p>

                    <iframe
                        width="600"
                        height="300"
                        frameborder="0" style="border:0"
                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCbEnku7Kl5mCIvWZgKOpgN-2wjmehRvyU&q={{ $partner->address }}"
                        allowfullscreen>
                    </iframe>


                    <p>住所: {{ $partner->address }}</p>
                    <p>電話番号: {{ $partner->phone }}</p>
                    <p>キャッチコピー: {{ $partner->catch_copy }}</p>
                </div>
            </div>

            <h2 class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">提供体験一覧</h2>
            <div class="d-flex justify-content-evenly flex-wrap">
                <ul class="horizontal-list">
                    @foreach ($experience_folders as $experience_folder)
                        @include('components.experience_small_cell', ['experienceFolder'=>$experience_folder])
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
@endsection
