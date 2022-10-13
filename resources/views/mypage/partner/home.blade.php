@extends('mypage.layouts.app')

@section('menu', 'owner_home')
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

    <h1>ようこそ {{ Auth::user()->name }} 様</h1>
    <div class="card">
        <div class="card-body">
            <p>名前: {{ Auth::user()->name }}</p>
            <p>メールアドレス: {{ Auth::user()->email }}</p>
            
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header d-flex">
            <p class="mb-0">予約された体験</p>
            <p class="mb-0 ms-3">本日と明日</p>
        </div>
        <div class="card-body">
        <table class="table table-hover">
            @forelse ($reserved_experiences as $reserved_experience)
                @if ($loop->first)
                    <thead>
                        <tr>
                            <th scope="col">予約者名</th>
                            <th scope="col">予約体験名</th>
                            <th scope="col">体験日</th>
                            <th scope="col">人数</th>
                            <th scope="col">宿泊</th>
                            <th scope="col">食事</th>
                            <th scope="col">連絡事項</th>
                            <th scope="col">受注状況</th>
                        </tr>
                    </thead>
                @endif
                <tr>
                    <td>
                        <p>{{ $reserved_experience->user->name }}様</p>
                    </td>
                    
                    <td>
                        <div class="d-flex flex-column">
                        <a class="link" href="/mypage/owner/reserve_edit/{{ $reserved_experience->id }}">
                            @if(App\Models\ExperienceFolder::where('id',$reserved_experience->experience->experience_folder_id)->first()->is_lodging == 0)
                                <p class="text-success">宿泊なし</p>
                            @else
                                <p class="text-primary">宿泊あり</p>
                            @endif
                            <p>{{ App\Models\ExperienceFolder::where('id',$reserved_experience->experience->experience_folder_id)->first()->name }}</p>
                            <p>{{ $reserved_experience->experience->name }}</p>
                        </a>   
                        </div> 
                    </td>
                    <td>
                        <p>{{ $reserved_experience->start_date }}</p>
                    </td>
                    
                    <td>
                        <p>
                            大人：{{ $reserved_experience->quantity_adult }}名<br>
                            子ども：{{ $reserved_experience->quantity_child }}名
                        </p>
                    </td>
                    <td>
                        <p>{{ $reserved_experience->hotelGroup?->name ?? 'なし' }}</p>
                    </td>
                    <td>
                        <p>{{ $reserved_experience->foodGroup?->name ?? 'なし' }}</p>
                    </td>
                    <td>
                        <p>{{ $reserved_experience->message }}</p>
                    </td>
                    <td> 
                    @if($reserved_experience->hotel_group_id == '')
                        <select name="save_flag" tabindex="-1" disabled 
                            @if($reserved_experience->status == 1 )
                            class="bg-danger text-white text-center" 
                            @else($reserved_experience->status == 5)
                            class="bg-primary text-white text-center"
                            @endif 
                            >
                            @foreach(App\Consts\OrderConst::STATUS_LIST as $key =>$val)
                                <option 
                                value="{{ $key }}" 
                                @if ($reserved_experience->status == $key ) 
                                selected 
                                @endif
                                    >
                                    {{$val}}
                                </option>       
                            @endforeach
                        </select>    
                    @else 
                        <select name="save_flag" tabindex="-1" disabled 
                            @if($reserved_experience->status == 1 ||$reserved_experience->status == 5 )
                            class="bg-danger text-white text-center" 
                            @else($reserved_experience->status == 10)
                            class="bg-primary text-white text-center"
                            @endif 
                            >
                            @foreach(App\Consts\OrderConst::STATUS_LIST as $key =>$val)
                                <option 
                                value="{{ $key }}" 
                                @if ($reserved_experience->status == $key ) 
                                selected 
                                @endif
                                    >
                                    {{$val}}
                                </option>       
                            @endforeach
                        </select>   
                    @endif 
                    </td>
                </tr>
                
            @empty

            @endforelse
            </table>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header d-flex">
            <p class="mb-0">処理が完了していない体験</p>
        </div>
        <div class="card-body">
        <table class="table table-hover">
            @forelse ($uncomplete_reserved_experiences as $reserved_experience)
                @if ($loop->first)
                    <thead>
                        <tr>
                            <th scope="col">予約者名</th>
                            <th scope="col">予約体験名</th>
                            <th scope="col">体験日</th>
                            <th scope="col">人数</th>
                            <th scope="col">宿泊</th>
                            <th scope="col">食事</th>
                            <th scope="col">連絡事項</th>
                            <th scope="col">受注状況</th>
                        </tr>
                    </thead>
                @endif
                <tr>
                    <td>
                        <p>{{ $reserved_experience->user->name }}様</p>
                    </td>
                    
                    <td>
                        <div class="d-flex flex-column">
                            <a class="link" href="/mypage/partner/reserve_edit/{{ $reserved_experience->id }}">
                                @if(App\Models\ExperienceFolder::where('id',$reserved_experience->experience->experience_folder_id)->first()->is_lodging == 0)
                                    <p class="text-success">宿泊なし</p>
                                @else
                                    <p class="text-primary">宿泊あり</p>
                                @endif
                                <p>{{ App\Models\ExperienceFolder::where('id',$reserved_experience->experience->experience_folder_id)->first()->name }}</p>
                                <p>{{ $reserved_experience->experience->name }}</p>
                            </a>
                        </div> 
                    </td>
                    <td>
                        <p>{{ $reserved_experience->start_date }}</p>
                    </td>
                    
                    <td>
                        <p>
                            大人：{{ $reserved_experience->quantity_adult }}名<br>
                            子ども：{{ $reserved_experience->quantity_child }}名
                        </p>
                    </td>
                    <td>
                        <p>{{ $reserved_experience->hotelGroup?->name ?? 'なし' }}</p>
                    </td>
                    <td>
                        <p>{{ $reserved_experience->foodGroup?->name ?? 'なし' }}</p>
                    </td>
                    <td>
                        <p>{{ $reserved_experience->message }}</p>
                    </td>
                    <td>
                    @if($reserved_experience->hotel_group_id == '')
                        <select name="save_flag" tabindex="-1" disabled 
                        @if($reserved_experience->status == 1 )
                        class="bg-danger text-white text-center" 
                        @else($reserved_experience->status == 5)
                        class="bg-primary text-white text-center"
                        @endif 
                        >
                            @foreach(App\Consts\OrderConst::STATUS_LIST as $key =>$val)
                                <option 
                                value="{{ $key }}" 
                                @if ($reserved_experience->status == $key ) 
                                selected 
                                @endif
                                    >
                                    {{$val}}
                                </option>       
                            @endforeach
                        </select>
                    @else
                        <select name="save_flag" tabindex="-1" disabled 
                        @if($reserved_experience->status == 1 ||$reserved_experience->status == 5 )
                        class="bg-danger text-white text-center" 
                        @else($reserved_experience->status == 10)
                        class="bg-primary text-white text-center"
                        @endif 
                        >
                            @foreach(App\Consts\OrderConst::LODGING_STATUS_LIST as $key =>$val)
                                <option 
                                value="{{ $key }}" 
                                @if ($reserved_experience->status == $key ) 
                                selected 
                                @endif
                                    >
                                    {{$val}}
                                </option>       
                            @endforeach
                        </select>
                    @endif        
                    </td>
                </tr>
                
            @empty

            @endforelse
            </table>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">処理が完了していないお土産</div>
        <div class="card-body">
        <table class="table table-hover">
            @forelse ($ordered_goods as $ordered_goods_one)
            @if ($loop->first)
                <thead>
                    <tr>
                        <th scope="col">送り主</th>
                        <th scope="col">注文商品名</th>
                        <th scope="col">注文商品責任者</th>
                        <th scope="col">商品注文日</th>
                        <th scope="col">注文商品数</th>
                        <th scope="col">商品に関する問い合わせ先</th>
                        <th scope="col">注文商品送り先情報</th>
                        <th scope="col">注文商品状況</th>
                    </tr>
                </thead>
            @endif
                <tr>
                    <td>
                        <p>{{ $ordered_goods_one->user->name }}様</p>
                    </td>
                    <td>
                        <a class="link" href="/mypage/owner/goods_reserve_edit/{{ $ordered_goods_one->id }}">
                            <p>{{ App\Models\GoodsFolder::where('id',$ordered_goods_one->goods->goods_folder_id)->first()->name }}</p>
                            <p>{{ $ordered_goods_one->goods->name }}</p>
                        </a>    
                    </td>
                    <td>
                        <p>{{ $ordered_goods_one->partner->name }}</p>  
                    </td>
                    <td>
                        <p>
                            {{$ordered_goods_one->created_at}}
                        </p>
                    </td>
                    <td>
                        <p>
                            {{$ordered_goods_one->quantity}}
                        </p>
                    </td>
                    <td>
                        <p>
                            {{$ordered_goods_one->partner->phone}}
                        </p>
                    </td>
                    <td> 
                        <p>氏名：{{$ordered_goods_one->to_name}}</p>
                        <p>郵便番号：{{$ordered_goods_one->to_postal_code}}</p>
                        <p>住所：{{App\Models\User::$prefs[$ordered_goods_one->to_pref_id]}}{{$ordered_goods_one->to_city}}{{$ordered_goods_one->to_town}}{{$ordered_goods_one->to_building}}<br>
                        電話番号：{{$ordered_goods_one->to_phone_number}}</p>
                    </td>
                    <td>
                        <select name="save_flag" tabindex="-1" disabled 
                        @if($reserved_experience->status == 1 ||$reserved_experience->status == 5 )
                        class="bg-danger text-white text-center" 
                        @else($reserved_experience->status == 10)
                        class="bg-primary text-white text-center"
                        @endif 
                        >
                            @foreach(App\Consts\OrderConst::GOODS_STATUS_LIST as $key =>$val)
                                <option 
                                value="{{ $key }}" 
                                @if ($reserved_experience->status == $key ) 
                                selected 
                                @endif
                                    >
                                    {{$val}}
                                </option>       
                            @endforeach
                        </select>    
                    </td>
                    
                </tr>
                
            @empty

            @endforelse
        </table>
        </div>
    </div>
    
    <div class="card mt-3 col-4">
        <div class="card-header">在庫数が減少しているお土産</div>
        <div class="card-body">
        <table class="table table-hover">
            @forelse ($decrease_goods as $decrease_good)
            @if ($loop->first)
                <thead>
                    <tr>
                        <th scope="col">商品名</th>
                        <th scope="col">残りの商品数</th>
                    </tr>
                </thead>
            @endif
                <tr>
                    <td>
                        <a class="link" href="/mypage/partner/goods/{{ $decrease_good->goods_folder_id }}">
                            <p>{{ $decrease_good->name }}</p>
                        </a>
                    </td>
                    <td>
                        <p class="text-danger">
                            {{ $decrease_good->quantity }}
                        </p>
                    </td>
                    
                </tr>
                
            @empty

            @endforelse
        </table>
        </div>
    </div>
</div>
@endsection
