@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">

            <h3 class="mb-3">内容確認</h3>
            <h5>以下の内容でよろしいかご確認ください</h5>

            <div class="mt-4">
                <h4>体験</h4>
                    @forelse($experienceCartItems as $experienceCartItem)
                        <div class="mt-1 p-3 card">
                            
                                <p>{{ $experienceCartItem->experience->name }}</p>
                                <p>予約日: {{ $experienceCartItem->start_date }}</p>
                                <p>大人: {{ $experienceCartItem->quantity_adult }}人 子ども: {{ $experienceCartItem->quantity_child }}人</p>
                                <p>宿泊: {{ $experienceCartItem->hotelGroup?->name ?? 'なし' }}</p>
                                <p>食事: {{ $experienceCartItem->foodGroup?->name ?? 'なし' }}</p>
                                <p>金額: {{ $experienceCartItem->sum_price() }}円</p>
                            
                        </div>
                    @empty
                        <p class="p-3">購入する体験はありません</p>
                    @endforelse
            </div>


            <div class="mt-4">
                <h4>{{App\Consts\ReuseConst::GOODS}}</h4> 
                @forelse($goodCartItems as $goodCartItem)
                    <div class="mt-1 p-3 card">
                        <div>
                            <p>名前: {{ $goodCartItem->goods->name }}</p>
                            <p>個数: {{ $goodCartItem->quantity }}</p>
                            <p>金額: {{ $goodCartItem->sum_price() }}円</p>
                        </div>
                    </div>
                @empty
                    <p class="p-3">購入する{{App\Consts\ReuseConst::GOODS}}はありません</p>
                @endforelse
              
            </div>


            <div class="mt-4 mb-2 d-flex align-items-center">
                <h5 class="mb-0">小計</h5>
                <p class="fs-4 fw-bold mb-0 ms-2"><span class="small_font fw-normal">税込</span>{{ number_format($price) }}円</p>
            </div>

            <div class="text-end">
                <a class="btn btn-warning" href="/cart/purchase">決算方法の決定へ</a>
            </div>

            
        </div>
    </div>
</div>

@endsection
