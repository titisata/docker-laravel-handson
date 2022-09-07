@extends('mypage.layouts.app')

@section('menu', 'partner_event')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex">
                <h1>イベント一覧</h1>
                <a href="/mypage/partner/event_add/{{ $user->id }}">
                    <div class="btn btn-success">
                        新規登録     
                    </div>
                </a>
            </div>
            
            @forelse($experiences_folders as $experienceFolder)
                <div class="card mb-3 ">
                    <div class="contain">
                        <a href="/mypage/partner/event/{{ $experienceFolder->id }}" style="text-decoration: none; color: inherit;">
                            <div class="d-lg-flex  justify-content-between"style="height: 100%; ">
                                <div class="img-square-wrapper img_box">
                                    <img style="object-fit: cover; height: 240px; width: 300px; " class="rounded-top image" src="{{ $experienceFolder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-start mb-0 text-truncate" >{{ $experienceFolder->name }}</h5>
                                    <p class="card-text fw-bold fs-4 text-nowrap text-end mt-auto">￥{{ number_format($experienceFolder->price_child) }}～</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <form action="/mypage/partner/action_event_delete" method="POST">
                        @csrf
                        <button class="btn btn-danger">イベント削除</button>
                        <input type="hidden" name="id" value="{{ $experienceFolder->id }}">
                    </form>
                </div>
                
            @empty
                <p>イベントがありません</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
