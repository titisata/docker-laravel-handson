@extends('mypage.layouts.app')

@section('menu', 'owner_reserve_edit')
@section('content')
<div class="container">
    <h1>注文商品詳細</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
        <p class="text-danger">{{ session('result') }}</p>
            <div class="card mt-3">
                <div class="card-header">注文商品詳細</div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-header">注文商品情報</div>
                            <div class="mb-3 ms-2">
                            @forelse(App\Models\Image::where('table_name', 'goods_folders')->where('table_id',$goods_order->goods->goods_folder_id)->get() as $image)
                                <div class="d-flex flex-column col-4 my-3">
                                    <img class="card-img" style="width: 200px;height: 140px; object-fit: cover;" src="{{ $image->image_path }}" alt="">
                                </div>
                            @empty
                            @endforelse        
                            </div>
                            <div class="mb-3 ms-2">
                                <a class="link" href="/goods/{{$goods_folder->id}}">
                                    <p>注文商品名：{{ $goods_folder->name }}</p>
                                </a>
                                
                            </div>
                            <div class="mb-3 ms-2">
                                <p>
                                    料金：{{ number_format($goods_folder->price) }}円
                                </p>
                            </div>
                            <div class="mb-3 ms-2">
                                <p>
                                    詳細：{{ $goods_folder->description }}
                                </p>
                            </div>
                            
                            <div class="mb-3 ms-2">
                                お問合せ：{{ $goods_order->contact_info }}
                            </div>
                        </div>
                   

                    <div class="card mt-3">
                        <div class="card-header">注文内容</div>

                        <p class="ms-2 mt-2 mb-1">注文者名：{{ $user->name }}様</p>
                    
                        <p class="ms-2 mt-2 mb-1">注文日：{{ $goods_order->created_at }}</p>
                    
                        <p class="ms-2 mt-2 mb-1">注文個数:{{ $goods_order->quantity }}個</p>
                        

                    </div>

                    <div class="my-3 card">
                        <div class="card-header">商品状況</div>
                        <p class="ms-2 mt-2 mb-1">配送会社：{{ $goods_order->delivery_company }}</p> 
                        @if( $goods_order->delivery_number != 0)       
                            <p class="ms-2 mb-1">配送会社：{{ $goods_order->delivery_number }}</p>
                        @endif    
                    </div>

                    <div class="my-3 card">
                        <div class="card-header">送り先情報</div>
                        <p class="ms-2 mt-2 mb-1">氏名：{{ $goods_order->to_name }}</p> 
                        <p class="ms-2 mb-1">郵便番号：{{ $goods_order->to_postal_code }}</p>
                        <p class="ms-2 mb-1">送り先住所：{{App\Models\User::$prefs[$goods_order->to_pref_id]}}{{ $goods_order->to_city }}{{ $goods_order->to_town }}{{ $goods_order->to_building }}<br>
                        送り先電話番号：{{ $goods_order->to_phone_number }}</p>
                    </div>
   
            </div>  
        </div>
    </div>
    
</div>
@endsection
