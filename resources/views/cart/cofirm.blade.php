@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-3">内容確認</h3>
            <h4>以下の内容でよろしいかご確認ください</h4>

            <div class="card">
                <div class="card-header">体験</div>
                <div class="card-body">
                    @forelse($experienceCartItems as $experienceCartItem)
                        <div class="mt-1 p-3 card">
                            <div>
                                <p>{{ $experienceCartItem->experience->name }}</p>
                                <p>予約日: {{ $experienceCartItem->experience->start_date }}</p>
                                <p>大人: {{ $experienceCartItem->quantity_adult }}人 子ども: {{ $experienceCartItem->quantity_child }}人</p>
                                <p>宿泊: {{ $experienceCartItem->hotelGroup?->name ?? 'なし' }}</p>
                                <p>食事: {{ $experienceCartItem->foodGroup?->name ?? 'なし' }}</p>
                                <p>金額: {{ $experienceCartItem->sum_price() }}円</p>
                            </div>
                        </div>
                    @empty
                        <p>購入する体験はありません</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-2 card">
                <div class="card-header">お土産</div>
                <div class="card-body">
                    @forelse($goodCartItems as $goodCartItem)
                        <div class="mt-1 p-3 card">
                            <div>
                                <p>名前: {{ $goodCartItem->goods->name }}</p>
                                <p>個数: {{ $goodCartItem->quantity }}</p>
                                <p>金額: {{ $goodCartItem->sum_price() }}円</p>
                            </div>
                        </div>
                    @empty
                        <p>購入するお土産はありません</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-2 mb-2 card">
                <div class="card-header">合計金額</div>
                <div class="card-body">
                    <p>{{ $price }}円</p>
                </div>
            </div>

            <a class="btn btn-primary" href="/cart/purchase">決算方法の決定へ</a>
        </div>
    </div>
</div>

@endsection
