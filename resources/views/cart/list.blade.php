@extends('layouts.app')


<script>
async function deleteExperience(id) {
    const obj = {
        id: id,
    };
    const method = "DELETE";
    const body = JSON.stringify(obj);
    const headers = {
        "Accept": "application/json",
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-TOKEN": "{{ csrf_token() }}",
    };
    fetch("/api/cart/experience", {method, headers, body})
        .then(_ => location.reload());
}
async function deleteGoods(id) {
    const obj = {
        id: id,
    };
    const method = "DELETE";
    const body = JSON.stringify(obj);
    const headers = {
        "Accept": "application/json",
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-TOKEN": "{{ csrf_token() }}",
    };
    fetch("/api/cart/goods", {method, headers, body})
        .then(_ => location.reload());
}
</script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-3">現在のカート</h3>

            <div class="">
                <h4>体験</h4>
                @forelse($experienceCartItems as $experienceCartItem)
                    <div class="mt-1 p-3 card">
                        <a href="/experience/{{ $experienceCartItem->experience->experience_folder_id }}">
                            <div>
                                <p>{{ $experienceCartItem->experience->name }}</p>
                                <p>予約日: {{ $experienceCartItem->start_date }}</p>
                                <p>大人: {{ $experienceCartItem->quantity_adult }}人 子ども: {{ $experienceCartItem->quantity_child }}人</p>
                                <p>宿泊: {{ $experienceCartItem->hotelGroup?->name ?? 'なし' }}</p>
                                <p>食事: {{ $experienceCartItem->foodGroup?->name ?? 'なし' }}</p>
                                <p>連絡事項: {{ $experienceCartItem->message }}</p>
                                <p>金額: {{ $experienceCartItem->sum_price() }}円</p>
                            </div>
                        </a>
                        <div>
                            <button class="btn btn-outline-primary"  onclick="deleteExperience({{ $experienceCartItem->id }})">削除</button>
                        </div>
                    </div>    
                @empty
                    <p class="p-3">カートが空です。</p>
                @endforelse

            </div>


            <div class="mt-4">
                <h4>お土産</h4>

                @forelse($goodCartItems as $goodCartItem)
                    <div class="mt-1 p-3 card">
                        <a href="/goods/{{ $goodCartItem->goods->goods_folder_id }}">
                            <div>
                                <p>名前: {{ $goodCartItem->goods->name }}</p>
                                <p>個数: {{ $goodCartItem->quantity }}</p>
                                <p>合計: {{ $goodCartItem->sum_price() }}円</p>
                            </div>
                        </a>
                        <div>
                            <button class="btn btn-outline-primary"  onclick="deleteGoods({{ $goodCartItem->id }})">削除</button>
                        </div>
                    </div>
                @empty
                    <p class="p-3">カートが空です。</p>
                @endforelse

            </div>

            <div class="mt-4 mb-2">
                <h4>合計金額</h4>
                <h5 class="p-3 fw-bold">{{ $price }}円</h5>
            </div>

            <div class="text-end">
                <a class=" btn btn-primary {{ $price == 0 ? 'disabled' : '' }} " href="/cart/confirm" style="{{ $price == 0 ? 'pointer-events:none;' : '' }} ">購入ページへ</a>
            </div>


        </div>
    </div>
</div>

@endsection
