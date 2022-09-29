@extends('mypage.layouts.app')

@section('menu', 'owner_reserve')
@section('content')

    <h1>進行中の予約一覧</h1>

    <div class="text-end me-5">
        <a href="/mypage/owner/reserve_past">過去の予約一覧へ</a>
    </div>
    
    <nav class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-link" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">体験別</a>
        <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">日付別</a>
    </nav>
        <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane active " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        @forelse ($partners as $partner)
        <div class="row justify-content-center">
            <div class="col-md-11 card mt-3">
                <div class="card-header d-flex align-items-center">
                    <h3 class="mb-0">{{ $partner->name }}様の予約状況</h3>
                    <!-- <a href="/mypage/owner/reserve_make/{id}" style="text-decoration: none; color: inherit;">
                        <button class="btn btn-sm btn-success ms-5">新規登録</button>
                    </a> -->
                </div>
                    @forelse ($partner->experiences as $experiences_folder)
                        <div class="mt-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <a href="/mypage/owner/reserve_select/{{$experiences_folder->id}}">
                                    <button class="btn btn-sm btn-success">予約確認</button>
                                </a>
                                    
                                <p class="ms-3 mb-0">{{ $experiences_folder->name }}への予約</p>
                                @if($experiences_folder->is_lodging == 0)
                                <p class="text-success mb-0 ms-3">宿泊なし</p>
                                @else
                                <p class="text-primary mb-0 ms-3">宿泊あり</p>
                                @endif
                            </div>    
                        </div>
                        
                    @empty
                        <p>体験がありません</p>
                    @endforelse     
            </div>
        </div>
    @empty
        <p>パートナーがいません</p>
    @endforelse
</div>
        <div class="tab-pane" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="row justify-content-center">
            <div class="col-md-11 card mt-3">
                <div class="card-header d-flex align-items-center">
                    <div class="d-flex flex-column">
                        @forelse ($dates as $date)
                        <a href="/mypage/owner/reserve_select_date/{{$date}}">
                            20{{$date}}月の予約
                        </a>
                        @empty
                            <p>体験がありません</p>
                        @endforelse
                    </div>
</div>  
</div>
</div>  
        </div>


@endsection
