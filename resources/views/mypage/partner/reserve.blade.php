
@extends('mypage.layouts.app')

@section('menu', 'owner_reserve')
@section('content')

    <h1>予約状況</h1>
        
   
        <div class="row justify-content-center">
        
            <div class="col-md-11 card mt-3"> 
            @forelse ($experiences_folders as $experiences_folder)
                        <div class="card mt-3">
                            <div class="card-header d-flex">
                                
                                @if($experiences_folder->is_lodging == 0)
                                <p class="text-success">宿泊なし</p>
                                @else
                                <p class="text-primary">宿泊あり</p>
                                @endif
                                
                                <p class="ms-3">{{ $experiences_folder->name }}への予約</p>
                            </div>
                            <div>  
                            <table class="table table-hover">
                                @forelse ($experiences_folder->reserves as $reserved_experience)
                                    @if ($loop->first)
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
                                    @endif
                                    <tr class="align-items-center">
                                        <th scope="row">
                                        
                                            {{ $reserved_experience->user->name }}様</th>
                                      
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
                                            @if( $reserved_experience->status == '対応待ち')
                                            <p class="bg-danger text-white mb-0 text-center">{{ $reserved_experience->status }}</p>
                                            @else
                                            <p class="bg-primary text-white mb-0 text-center">{{ $reserved_experience->status }}</p>
                                            @endif
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
    
    

@endsection

