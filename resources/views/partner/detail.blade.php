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

<div class="container px-0">
    <div class="row justify-content-center" style="--bs-gutter-x: 0;">
        <div class="col-md-10">

            <div class="mt-5">
                <h3 class="fw-bold pb-3 ps-2">{{ $partner->name }}</h3>
                <div class="">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <img class="w-100" src="{{ $partner->images()[0]?->image_path ?? '/images/empty.png'}}" style="height:400px;object-fit: cover;" alt="">
                    </div>
                    <p class="ps-2">{{ $partner->description }}</p>

                    
                    <h4 class="fw-bold pt-4 ps-2">アクセス</h4>
                    <p class="ps-2">{{ $partner->access }}</p>
                    <p class="ps-2">住所: {{ $partner->address }}　電話番号: {{ $partner->phone }}</p>
                    <iframe
                        width="100%"
                        height="300"
                        frameborder="0" style="border:0"
                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCbEnku7Kl5mCIvWZgKOpgN-2wjmehRvyU&q={{ $partner->address }}"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>

            <h2 class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">提供体験一覧</h2>
            <div class="d-flex justify-content-evenly flex-wrap px-0">
                <ul class="horizontal-list ps-0">
                    @foreach ($experience_folders as $experience_folder)
                        @include('components.experience_small_cell', ['experienceFolder'=>$experience_folder])
                    @endforeach
                </ul>
            </div>

            <h2 class="mt-5 mb-4 ms-3 ms-md-0 fw-bold">会社情報</h2>
            <div class="d-flex justify-content-evenly flex-wrap px-0">
                <ul class="horizontal-list ps-0">
                    @foreach ($links as $link)
                    <div>
                        <a class="fs-2" href="/partner/partner_link_show/{{ $link->id }}">{{ $link->name }}</a>
                    </div>   
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
@endsection
