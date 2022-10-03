@extends('mypage.layouts.app')

@section('menu', 'owner_reserve')
@section('content')
<div class="container">
    <div class="d-flex flex-column">
        <h1>未対応注文一覧</h1>
        <p>お土産名：{{ $goods_folder->name}}</p>
    </div>
    

<div>  
    <table class="table table-hover">
    @forelse ($goods as $one_goods)
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
        @forelse ($one_goods->goods_orders as $order)
            
            <tr>
                <td>
                    <p>{{ $order->user->name }}様</p>
                </td>
                <td>
                    <a href="/mypage/owner/goods_reserve_edit/{{$order->id}}">
                        <p>{{ App\Models\GoodsFolder::where('id',$order->goods->goods_folder_id)->first()->name }}</p>
                        <p>{{ $order->goods->name }}</p>
                    </a>  
                </td>
                <td>
                    <p>{{ $order->partner->name }}</p>  
                </td>
                <td>
                    <p>
                        {{ $order->created_at }}
                    </p>
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
                    
                    @if( $order->status == '未対応' )
                        <p class="bg-danger text-white text-center">{{ $order->status }}</p>
                    @else
                        <p class="bg-primary text-white text-center">{{ $order->status }}</p>
                    @endif
                    
                </td>
            
        </tr>
            
        @empty

        @endforelse
        
    @empty
        
    @endforelse
    </table>
</div>
</div>
@endsection