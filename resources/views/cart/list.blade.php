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
        <div class="col-md-8 mt-4">

            <div class="d-flex justify-content-between mb-4">
                <h3 class="mb-0">現在のカート</h3>
                <div class="d-flex">
                    <a href="/search/experience">
                        他の体験を予約する
                    </a>
                    <a class="ms-3" href="/search/goods">
                        他の名産品を購入する
                    </a>
                </div>

            </div>
            
                
            <h4 >合計金額</h4>
            <p class="fs-4 fw-bold ms-3"><span class="small_font fw-normal">送料・税込</span>{{ number_format($price) }}円</p>
            
            <div class="text-end mb-2">
                <a class="btn btn-warning {{ $price == 0 ? 'disabled' : '' }}" href="/cart/purchase" style="{{ $price == 0 ? 'pointer-events:none;' : '' }} ">決算方法の決定へ</a>
            </div>

                

                <div class="">
                    <h4>体験</h4>
                    @forelse($experienceCartItems as $experienceCartItem)
                        <div class="mt-1 p-3 card">
                            <a href="/experience/{{ $experienceCartItem->experience->experience_folder_id }}">
                                <div>
                                    <p>{{ App\Models\ExperienceFolder::where('id',$experienceCartItem->experience->experience_folder_id)->first()->name }}　　{{ $experienceCartItem->experience->name }}</p>
                                    <p>体験日: {{ $experienceCartItem->start_date }}</p>
                                    <p>大人: {{ $experienceCartItem->quantity_adult }}人 子ども: {{ $experienceCartItem->quantity_child }}人</p>
                                    <p>宿泊: {{ $experienceCartItem->hotelGroup?->name ?? 'なし' }}</p>
                                    <p>食事: {{ $experienceCartItem->foodGroup?->name ?? 'なし' }}</p>
                                    <p>連絡事項: {{ $experienceCartItem->message ?? 'なし'}}</p>
                                    <p>金額: <span class="small_font fw-normal">税込</span>{{ number_format($experienceCartItem->sum_price()) }}円</p>
                                    <p>カート登録日: {{ $experienceCartItem->created_at }}</p>
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
                    <h4>名産品</h4>

                    @forelse($goodCartItems as $goodCartItem)
                        <div class="mt-1 p-3 card">
                            <a href="/goods/{{ $goodCartItem->goods->goods_folder_id }}">
                                <div>
                                    <p>商品名: {{ $goodCartItem->goods->name }}</p>
                                    <p>個数: {{ $goodCartItem->quantity }}</p>
                                    <p>合計: <span class="small_font fw-normal me-1">送料・税込</span>{{ number_format($goodCartItem->sum_price()) }}円</p>
                                    <p>カート登録日: {{ $goodCartItem->created_at }}</p>
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

                
                
            </div>
                

        </div>
    </div>
</div>

@endsection
