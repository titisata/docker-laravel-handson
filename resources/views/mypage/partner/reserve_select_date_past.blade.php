@extends('mypage.layouts.app')

@section('menu', 'owner_reserve')
@section('content')
<style>
    select {
        -webkit-appearance: none;/* ベンダープレフィックス(Google Chrome、Safari用) */
        -moz-appearance: none; /* ベンダープレフィックス(Firefox用) */
        appearance: none; /* 標準のスタイルを無効にする */
        }
        ::-ms-expand { /* select要素のデザインを無効にする（IE用） */
        display: none;
        }
</style>
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
            <th scope="col">進捗状況</th>
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
            @if($reserve->hotel_group_id == '')
                <select name="save_flag" tabindex="-1" disabled 
                    @if($reserve->status == 1 )
                    class="bg-danger text-white text-center" 
                    @else($reserve->status == 5)
                    class="bg-primary text-white text-center"
                    @endif 
                    >
                    @foreach(App\Consts\OrderConst::STATUS_LIST as $key =>$val)
                        <option 
                        value="{{ $key }}" 
                        @if ($reserve->status == $key ) 
                        selected 
                        @endif
                            >
                            {{$val}}
                        </option>       
                    @endforeach
                </select>    
            @else 
                <select name="save_flag" tabindex="-1" disabled 
                    @if($reserve->status == 1 ||$reserve->status == 5 )
                    class="bg-danger text-white text-center" 
                    @else($reserve->status == 10)
                    class="bg-primary text-white text-center"
                    @endif 
                    >
                    @foreach(App\Consts\OrderConst::STATUS_LIST as $key =>$val)
                        <option 
                        value="{{ $key }}" 
                        @if ($reserve->status == $key ) 
                        selected 
                        @endif
                            >
                            {{$val}}
                        </option>       
                    @endforeach
                </select>   
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