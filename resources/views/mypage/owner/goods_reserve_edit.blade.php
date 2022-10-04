@extends('mypage.layouts.app')

@section('menu', 'owner_reserve_edit')
@section('content')
<div class="container">
    <h1>お土産予約編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
        <p class="text-danger">{{ session('result') }}</p>
            <div class="card mt-3">
                <div class="card-header">お土産予約編集</div>
                <div class="card-body">
                    <form action="/mypage/owner/goods_reserve_edit/{{ $goods_order->id }}" method="POST">
                        @csrf
                       
                        <div class="mb-3">
                            <p>送り主:{{ $goods_order->user->name }}様</p>
                        </div>
                        <div class="mb-3">
                            
                            <p>注文商品名:{{ App\Models\GoodsFolder::where('id',$goods_order->goods->goods_folder_id)->first()->name }}</p>
                            <p>{{ $goods_order->goods->name }}</p>
                               
                        </div>
                        <div class="mb-3">
                            
                            <p>注文商品責任者：{{ $goods_order->partner->name }}</p>
                        </div>
                        <div class="mb-3">
                           
                            <p>商品注文日：{{ $goods_order->created_at }}</p>
                        </div>
                        <div class="mb-3">
                
                            <p>注文商品数 : {{ $goods_order->quantity }}個</p>
                        </div>
                        <div class="mb-3">
                            
                            <p>商品に関する問い合わせ先:{{ $goods_order->partner->phone }}</p>
                        </div>
                         
                        <div> 
                            <p>氏名：{{ $goods_order->to_name }}</p>
                            <p>郵便番号：{{ $goods_order->to_postal_code }}</p>
                            <p>住所：{{App\Models\User::$prefs[$goods_order->to_pref_id]}}{{ $goods_order->to_city }}{{ $goods_order->to_town }}{{ $goods_order->to_building }}<br>
                            電話番号：{{ $goods_order->to_phone_number }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">注文商品状況</label>
                            <input name="status" type="text" class="form-control" value="{{ $goods_order->status }}">
                        </div> 
                        <!-- <div>
                            <label for="">確認メール送信</label>
                            <div class="d-flex flex-column">
                                <div>
                                    <input id="n_mail" name="mail" type="radio" value="0" checked>
                                    <label for="n_mail" class="fw-normal">メール送信しない</label>
                                </div>
                                <div>
                                    <input id="f_mail" name="mail" type="radio" value="1">
                                    <label for="f_mail" class="fw-normal">ホテル確定メール送信</label>
                                </div>
                                <div>
                                    <input id="s_mail" name="mail" type="radio" value="2">
                                    <label for="s_mail" class="fw-normal">予約ステータス変更メール送信</label>
                                </div>
                                
                            </div> 
                        </div> -->
                        

                    <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                    
                    
            
                </div>
            </div>  
        </div>
    </div>
    
</div>
@endsection
