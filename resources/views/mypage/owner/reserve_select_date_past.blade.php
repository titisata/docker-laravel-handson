@extends('mypage.layouts.app')

@section('menu', 'owner_reserve')
@section('content')
<div class="container">
    <h1>過去予約一覧</h1>

<div>  
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">予約日</th>
            <th scope="col">体験名</th>
            <th scope="col">人数</th>
            <th scope="col">宿泊</th>
            <th scope="col">食事</th>
            <th scope="col">連絡事項</th>
            <th scope="col">ステータス</th>
            <th scope="col">選定ホテル</th>
        </tr>
    </thead>
    @forelse ($reserves as $reserve)
         
        <tr>
            <td>
                <p>{{ $reserve->start_date }}</p>
                
            </td>
            <td>
                <p>{{ App\Models\ExperienceFolder::where('id', $reserve->experience->experience_folder_id)->first()->name }}</p>
                <p>{{ $reserve->experience->name }}</p>
            </td>
            <td>
                <p>
                    大人：{{ $reserve->quantity_adult }}人<br>
                    子ども：{{ $reserve->quantity_child }}人
                </p>
            </td>
            <td>
                <p>
                    {{ $reserve->hotelGroup?->name ?? 'なし' }}
                </p>
            
            </td>
            <td>
                <p>
                {{ $reserve->foodGroup?->name ?? 'なし' }}
                </p>
            
            </td>
            <td>
            
               <p>{{ $reserve->message }}</p> 
            
            </td>
            <td>
                @if( $reserve->status == '対応待ち')
                <p class="bg-danger text-white mb-0 text-center">{{ $reserve->status }}</p>
                @else
                <p class="bg-primary text-white mb-0 text-center">{{ $reserve->status }}</p>
                @endif
            </td>
            <td>
                <p>{{ $reserve->hotel->name ?? '未確定'}}</p>
            </td>
            
        </tr>
        
    @empty
        
    @endforelse
    </table>
</div>
</div>
@endsection