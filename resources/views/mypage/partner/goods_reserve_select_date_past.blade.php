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
    <h1>予約一覧</h1>

<div>  
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">商品注文日</th>
            <th scope="col">送り主</th>
            <th scope="col">注文商品名</th>
            <th scope="col">注文商品責任者</th>
            <th scope="col">注文商品数</th>
            <th scope="col">商品に関する問い合わせ先</th>
            <th scope="col">注文商品送り先情報</th>
            <th scope="col">注文商品状況</th>
        </tr> 
    </thead>
    @forelse ($orders as $order)
         
    <tr>
        <td>
            
            <p>
                {{ $order->created_at }}
            </p>
            
        </td>
        <td>
            <p>{{ $order->user->name }}様</p>
        </td>
        <td>
            <p>{{ App\Models\GoodsFolder::where('id',$order->goods->goods_folder_id)->first()->name }}</p>
            <p>{{ $order->goods->name }}</p>
        </td>
        <td>
            <p>{{ $order->partner->name }}</p>  
        </td>
        <td>
            <p>
                {{ $order->quantity }}
            </p>
        </td>
        <td>
            <p>
                {{ $order->partner->phone }}
            </p>
        </td>
        <td> 
            <p>氏名：{{ $order->to_name }}</p>
            <p>郵便番号：{{ $order->to_postal_code }}</p>
            <p>住所：{{App\Models\User::$prefs[$order->to_pref_id]}}{{ $order->to_city }}{{ $order->to_town }}{{ $order->to_building }}<br>
            電話番号：{{ $order->to_phone_number }}</p>
        </td>
        <td>
            
            <select name="save_flag" tabindex="-1" disabled 
                @if($order->status == 1 ||$order->status == 5 )
                class="bg-danger text-white text-center" 
                @else($order->status == 10)
                class="bg-primary text-white text-center"
                @endif 
                >
                @foreach(App\Consts\OrderConst::GOODS_STATUS_LIST as $key =>$val)
                    <option 
                    value="{{ $key }}" 
                    @if ($order->status == $key ) 
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