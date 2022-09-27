@extends('mypage.layouts.app')

@section('menu', 'owner_reserve')
@section('content')

    <h1>予約状況</h1>
        
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
                        <div class="card mt-3">
                            <div class="card-header">{{ $experiences_folder->name }}への予約</div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">ユーザー名</th>
                                            <th scope="col">予約日</th>
                                            <th scope="col">人数</th>
                                            <th scope="col">宿泊</th>
                                            <th scope="col">食事</th>
                                            <th scope="col">連絡事項</th>
                                            <th scope="col">ステータス</th>
                                            <th scope="col">選定ホテル</th>
                                        </tr>
                                    </thead>
                                    @forelse ($experiences_folder->reserves as $reserved_experience)
                                        <tr class="align-items-center">
                                            <th scope="row">
                                            <a href="/mypage/owner/reserve_edit/{{ $reserved_experience->experience->id }}">
                                                {{ $reserved_experience->user->name }}様</th>
                                            </a> 
                                            <td>
                                                {{ $reserved_experience->experience->start_date }}
                                            </td>
                                            <td>
                                                    大人: {{ $reserved_experience->quantity_adult }}人 子ども: {{ $reserved_experience->quantity_child }}人
                                            </td>  
                                            <td>
                                                {{ $reserved_experience->hotelGroup?->name ?? 'なし' }}
                                            </td>
                                            <td>
                                                {{ $reserved_experience->foodGroup?->name ?? 'なし' }}
                                            </td>
                                            <td>
                                                {{ $reserved_experience->message }}
                                            </td>
                                            <td>
                                                {{ $reserved_experience->status }}
                                            </td>
                                            <td>
                                            {{ $reserved_experience->hotel->name ?? '未確定'}}
                                            </td>
                                        </tr>   
                                    @empty
                                        <p>予約がありません</p>
                                    @endforelse
                                </table>
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
        
    

@endsection
