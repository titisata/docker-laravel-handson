@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-3">現在のカート</h3>

            <div class="card">
                <div class="card-header">体験</div>
                <div class="card-body">
                    @forelse($experienceCartItems as $experienceCartItem)
                        <a href="/experience/{{ $experienceCartItem->experience->id }}">
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
                        </a>
                    @empty
                        <p>カートが空です</p>
                    @endforelse
                </div>
            </div>


            <div class="mt-2 card">
                <div class="card-header">お土産</div>
                <div class="card-body">
                    @forelse($goodCartItems as $goodCartItem)
                        <a href="/goods/{{ $goodCartItem->goods_id }}">
                            <div class="mt-1 p-3 card">
                                <div>
                                    <p>名前: {{ $goodCartItem->goods->name }}</p>
                                    <p>個数: {{ $goodCartItem->quantity }}</p>
                                    <p>合計: {{ $goodCartItem->sum_price() }}円</p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p>カートが空です</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-2 mb-2 card">
                <div class="card-header">合計金額</div>
                <div class="card-body">
                    <p>{{ $price }}円</p>
                </div>
            </div>

            <a class="btn btn-primary {{ $price == 0 ? 'disabled' : '' }} " href="/cart/confirm" style="{{ $price == 0 ? 'pointer-events:none;' : '' }} ">購入ページへ</a>
        </div>
    </div>
</div>

@endsection
