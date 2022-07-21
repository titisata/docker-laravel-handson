@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
<style>
.card-img-overlay{
    padding: 0;
    top: calc(90% - 0.5rem);
    text-align: center;
    font-weight: bold;
}
.btn-pink{
    background-color:#FB6E86;
    border-color:#FB6E86;
    color:white;
}
.btn-pink:hover{
    color:#FB6E86;
}
</style>

<script>
   
async function commentCreate(goods_folder_id) {
    const content = document.getElementById('comment');
    const rate = document.getElementById('rate_input');
    const obj = {
        goods_folder_id: goods_folder_id,
        rate: Number(rate.value),
        content: content.value,
    };
    content.value = "";
    const method = "POST";
    const body = JSON.stringify(obj);
    const headers = {
        "Accept": "application/json",
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-TOKEN": "{{ csrf_token() }}",
    };
    fetch("/api/comment/goods", {method, headers, body})
        .then(_ => location.reload());
}
</script>
<script>
    

    function goods_formSwitch(id){
        var goods_result = document.getElementById(`goods_result_${id}`);
        var goods_price = document.getElementById(`goods_price_${id}`);
        var count = document.getElementById(`count_${id}`).value;

        goods_result.innerHTML = (goods_price.innerHTML*count);
        
    }

    function check(){
        var flag = 0;
          var msg = "入力エラー";

        var goods_result = document.getElementById('goods_result');
        if(goods_result.innerHTML == '0' ){
            flag = 1;
            msg = msg + "\n個数が選択されていません";
        }

        if(flag == 1){
              alert(msg);
              return false;
          }else{
               return true;
              }
        

    }
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="height: 300px;">
                <img class="card-img img-thumbnail" style="height: 100%; object-fit: cover;" src="{{ $goods_folder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="">
               
            </div>

        
                <p>会社名: <a href="/partner/{{ $goods_folder->partner->id }}">{{ $goods_folder->partner->name }}</a></p>
                <div class="d-flex mt-3">
                    <h4 class="fw-bold">商品名：</h4>
                    <h4 class="fw-bold"> {{ $goods_folder->name }}</h4>
                </div>
                
                <h5 class="fw-bold mt-4">商品説明</h5>
                <p>{{ $goods_folder->description }}</p>

                @forelse($goods_folder->goods as $goods)
                <form class="mb-3 mt-3" action="{{ Request::url() }}" method="POST" onsubmit='return check();'>    
                    <div class="card">
                        @csrf
                        <p>{{ $goods->name }}</p>
                        
                        <p class="fw-bold text-end h3 pt-3"><span id="goods_price_{{ $goods->id }}" value="">{{ $goods->price }}</span>円/個</p>
                        <div class="d-flex align-items-center justify-content-end pb-4 border-bottom">
                            <label class="fs-5 me-1" for="quantity">数量</label>
                            <div class="d-flex">
                                <select class="form-select form-select-sm me-1" style="width:64px" name="quantity" id="count_{{ $goods->id }}" onchange="goods_formSwitch('{{ $goods->id }}')">
                                    <option value="0" selected="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                                
                            </div>    
                        </div> 
                        <p class="text-end border-top pt-3 fs-4 fw-bold">合計金額：<span id="goods_result_{{ $goods->id }}" class="fs-4">0</span>円</p>

                    </div>
                    
                @empty
                    <p>商品がありません</p>
                @endforelse
                    <div class="text-center text-md-end pt-3">
                        <button class="btn btn-pink btn-light m-2 text-center fw-bold rounded-pill shadow-sm fs-4 col-8 col-lg-4"  type="submit" value="">
                            <i class="bi bi-cart"></i>カートに入れる
                        </button>
                    </div>
                </form>
            <div class="my-5">
                <h5 class="mb-0 fw-bold">注意事項など</h5>
                
                <p>このテキストはサンプルです。このテキストはサンプルです。このテキストはサンプルです。このテキストはサンプルです。
                このテキストはサンプルです。このテキストはサンプルですこのテキストはサンプルです。このテキストはサンプルです。
                </p>

            </div>
            

            <div class="mt-2 card">
                <div class="d-flex flex-column">
                    <h4 class="m-3 fw-bold">クチコミ</h4>
                   
                    <div class="m-3">
                    <textarea class="form-control" row="10" cols="60" placeholder="コメント" id="comment"></textarea>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <select class="form-select" id="rate_input" style="width:80px;" >
                                <option value="1">☆1</option>
                                <option value="2">☆2</option>
                                <option value="3">☆3</option>
                                <option value="4">☆4</option>
                                <option value="5" selected="selected">☆5</option>
                            </select>
                            <button class="btn btn-outline-primary" onclick="commentCreate({{ $goods_folder->id }})">投稿</button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @foreach ($comments as $comment)
                        <div class="mt-2">
                            @include('components.comment_cell', ['comment'=>$comment])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
