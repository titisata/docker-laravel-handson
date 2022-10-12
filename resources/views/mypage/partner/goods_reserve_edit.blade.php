@extends('mypage.layouts.app')

@section('menu', 'owner_reserve_edit')
@section('content')
<script type="text/javascript">
<!--
function changeDisabled() {
    if ( document.Form1["delivery_company"][3].checked ) { // 「その他」のラジオボタンをクリックしたとき
        document . Form1["input_company"] . disabled = false; // 「その他」のラジオボタンの横のテキスト入力欄を有効化
    } else { // 「その他」のラジオボタン以外をクリックしたとき
        document . Form1["input_company"] . disabled = true; // 「その他」のラジオボタンの横のテキスト入力欄を無効化
    }
}
window.onload = changeDisabled; // ページを表示したとき、changeDisabled() を呼び出す
// -->
</script>
<div class="container">
    <h1>お土産予約編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
        <p class="text-danger">{{ session('result') }}</p>
            <div class="card mt-3">
                <div class="card-header">お土産予約編集</div>
                <div class="card-body">
                    <form name="Form1" action="/mypage/partner/goods_reserve_edit/{{ $goods_order->id }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">ステータス</label>
                            <select name="save_flag" >
                                @foreach(App\Consts\OrderConst::GOODS_STATUS_LIST as $key =>$val)
                                    <option value="{{ $key }}" @if ($goods_order->status == $key ) selected @endif >{{$val}}</option>       
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">配送業者名</label>
                            @foreach(App\Consts\DeliveryConst::DELIVERY_LIST as $key =>$val)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="delivery_company" id="{{$val}}" value="{{ $key }}" @if ($goods_order->delivery_company == $key ) selected @endif>
                                    <label class="form-check-label" for="{{$val}}">{{$val}}</label>
                                </div>  
                            @endforeach
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="delivery_company" value="" id="radio-other" onClick="changeDisabled()">
                                <label class="form-check-label " for="radio-other">その他</label>
                                <input name="input_company" type="text" class="form-control" style="width:300px" value="{{ $goods_order->delivery_company }}">
                            </div>  
                            
                           
                        </div> 

                        <div class="mb-3">
                            <label class="form-label">配送伝票番号</label>
                            <input name="delivery_number" type="text" class="form-control" value="{{ $goods_order->delivery_number }}">
                        </div> 
                        

                        <div class="mb-3 card">
                            <div class="card-header">送り主情報</div>
                            <p class="ms-2 mt-2 mb-1">送り主：{{ $goods_order->user->name }}様</p>
                            <p class="ms-2 mb-1">郵便番号：{{ $goods_order->from_postal_code }}</p>
                            <p class="ms-2 mb-1">住所：{{App\Models\User::$prefs[$goods_order->from_pref_id]}}{{ $goods_order->from_city }}{{ $goods_order->from_town }}{{ $goods_order->from_building }}<br>
                            電話番号：{{ $goods_order->from_phone_number }}</p>
                        </div>

                        <div class="mb-3 card">
                            <div class="card-header">送り先情報</div>
                            <p class="ms-2 mt-2 mb-1">氏名：{{ $goods_order->to_name }}</p> 
                            <p class="ms-2 mb-1">郵便番号：{{ $goods_order->to_postal_code }}</p>
                            <p class="ms-2 mb-1">送り先住所：{{App\Models\User::$prefs[$goods_order->to_pref_id]}}{{ $goods_order->to_city }}{{ $goods_order->to_town }}{{ $goods_order->to_building }}<br>
                            送り先電話番号：{{ $goods_order->to_phone_number }}</p>
                        </div>

                        <div class="mb-3">
                            <p>注文商品名：{{ App\Models\GoodsFolder::where('id',$goods_order->goods->goods_folder_id)->first()->name }}
                            <span class="ms-3">{{ $goods_order->goods->name }}</span></p>       
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
                         
                    

                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                    
                    
            
                </div>
            </div>  
        </div>
    </div>
    
</div>
@endsection
