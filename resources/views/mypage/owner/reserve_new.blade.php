@extends('mypage.layouts.app')

@section('menu', 'owner_reserve')
@section('content')
<div class="container">
    <h1>新規予約作成</h1>
       
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="mb-0">新規予約項目登録</h3>
                    </div>
                        @forelse ($partner->experiences as $experiences_folder)
                            <div class="card mt-3">
                                <div class="card-header">{{ $experiences_folder->name }}への予約</div>
                                <div class="card-body">
                                    @forelse ($experiences_folder->reserves as $reserved_experience)
                                        <div class="mt-1 p-3 card">
                                            <div>
                                                <p>名前: {{ $reserved_experience->user->name }}様</p>
                                                <p>予約日: {{ $reserved_experience->experience->start_date }}</p>
                                                <p>大人: {{ $reserved_experience->quantity_adult }}人 子ども: {{ $reserved_experience->quantity_child }}人</p>
                                                <p>宿泊: {{ $reserved_experience->hotelGroup?->name ?? 'なし' }}</p>
                                                <p>食事: {{ $reserved_experience->foodGroup?->name ?? 'なし' }}</p>
                                                <p>連絡事項: {{ $reserved_experience->message }}</p>
                                                <p>ステータス: {{ $reserved_experience->status }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <p>予約はありません</p>
                                    @endforelse
                                </div>
                            </div>
                        @empty
                            <p>体験がありません</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p>パートナーがいません</p>
    @endforelse
        
    
</div>
@endsection
