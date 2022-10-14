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
    <div class="d-flex flex-column">
        <h1>検索結果</h1>
    </div>
    

<div>  
    <table class="table table-hover">
    @forelse ($goods as $one_goods)
        @if ($loop->first)
            <thead>
                <tr>
                    <th scope="col">送り主</th>
                    <th scope="col">注文商品名</th>
                    <th scope="col">出展者名</th>
                    <th scope="col">商品注文日</th>
                    <th scope="col">注文商品数</th>
                    <th scope="col">決済ID</th>
                    <th scope="col">注文商品送り先情報</th>
                    <th scope="col">注文商品状況</th>
                </tr>       
            </thead>
        @endif    
            
        <tr>
            <td>
                <p>{{ $one_goods->user->name }}様</p>
            </td>
            <td>
                <a class="link" href="/mypage/partner/goods_reserve_edit/{{$one_goods->id}}">
                    <p>{{ App\Models\GoodsFolder::where('id',$one_goods->goods->goods_folder_id)->first()->name }}</p>
                    <p>{{ $one_goods->goods->name }}</p>
                </a>  
            </td>
            <td>
                <p>{{ $one_goods->partner->name }}</p>  
            </td>
            <td>
                <p>
                    {{ $one_goods->created_at }}
                </p>
            </td>
            <td>
                <p>
                    {{ $one_goods->quantity }}
                </p>
            </td>
            <td>
                <p>
                    {{ $one_goods->payment_id }}
                </p>
            </td>
            <td> 
                <p>氏名：{{ $one_goods->to_name }}</p>
                <p>郵便番号：{{ $one_goods->to_postal_code }}</p>
                <p>住所：{{App\Models\User::$prefs[$one_goods->to_pref_id]}}{{ $one_goods->to_city }}{{ $one_goods->to_town }}{{ $one_goods->to_building }}<br>
                電話番号：{{ $one_goods->to_phone_number }}</p>
            </td>
            <td>
                <select name="save_flag" tabindex="-1" disabled 
                @if($one_goods->status == 1 ||$one_goods->status == 5 )
                class="bg-danger text-white text-center" 
                @else($one_goods->status == 10)
                class="bg-primary text-white text-center"
                @endif 
                >
                @foreach(App\Consts\OrderConst::GOODS_STATUS_LIST as $key =>$val)
                    <option 
                    value="{{ $key }}" 
                    @if ($one_goods->status == $key ) 
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
@endsection