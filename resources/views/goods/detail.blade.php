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
async function commentCreate(goods_id) {
    const content = document.getElementById('comment');
    const rate = document.getElementById('rate_input');
    const obj = {
        goodsId: goods_id,
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="height: 200px;">
                <img class="card-img" style="height: 100%; object-fit: cover;" src="{{ $goods->images()[0]->image_path }}" alt="">
                <div class="card-img-overlay"  style=" background: linear-gradient(rgba(0,0,0,0),rgba(251, 110, 134));">
                    <h3 class="text-white fw-bold" style="--bs-bg-opacity: .5;" >{{ $goods->name }}</h3>
                </div>
            </div>

            <form class="mb-3 mt-3" action="{{ Request::url() }}" method="POST">
                @csrf
        
                
                <p class="fw-bold h4"> {{ $goods->name }}</p>
                <p>{{ $goods->description }}</p>
                <p></p>
                <p class="fw-bold text-end h3 border-top pt-3">{{ $goods->price }}円/個</p>
                <div class="d-flex align-items-center justify-content-end">
                    <label for="quantity">数量</label>
                    <div class="d-flex">
                        <select class="form-select form-select-sm me-1" style="width:64px" name="quantity" onchange="formSwitch()">
                                <option selected=""></option>
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
                <!-- <div class="text-end my-3 ">
                        <input type="submit" class="btn btn-primary w-100 rounded-pill" href="" value="カートに入れる">
                </div> -->
                <div class="text-center text-md-end">
                        <button class="btn btn-pink btn-light m-2 text-center fw-bold rounded-pill shadow-sm fs-4" style="width:240px" type="submit" value="">
                            <i class="bi bi-cart"></i>カートに入れる
                        </button>
                </div>
            </form>
            <div class="my-3">
                <h5 class="mb-0">注意事項など</h5>
                
                <p>このテキストはサンプルです。このテキストはサンプルです。このテキストはサンプルです。このテキストはサンプルです。
                このテキストはサンプルです。このテキストはサンプルですこのテキストはサンプルです。このテキストはサンプルです。
                </p>

            </div>
            

            
            <!-- <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">注意事項など</h5>
                </div>
                <div class="card-body">
                    <p>このテキストはサンプルです。このテキストはサンプルです。このテキストはサンプルです。このテキストはサンプルです。
                    このテキストはサンプルです。このテキストはサンプルですこのテキストはサンプルです。このテキストはサンプルです。
                    </p>

                </div>

            </div> -->
            

            <!-- <div class="card mt-3">
                <div class="card-header">詳細</div>
                <div class="card-body">
                    <p>名前: {{ $goods->name }}</p>
                    <p>値段: {{ $goods->price }}円</p>
                    <p>説明: {{ $goods->description }}</p>
                    <form class="mb-3 mt-3" action="{{ Request::url() }}" method="POST">
                        @csrf
                        <label for="quantity">個数</label>
                        <div class="d-flex">
                            <select class="form-select form-select-sm me-1" style="width:64px" name="quantity" onchange="formSwitch()">
                                    <option selected=""></option>
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
                            <input type="submit" class="btn btn-primary" href="" value="カートに入れる">
                        </div>
                       
                    </form>
                </div>
            </div> -->

            <div class="mt-2 card">
                <div class="card-header">
                    <h5 class="mb-0">口コミ</h5>
                </div>

                <div class="d-flex flex-column">
                    <div class="m-2">
                    <textarea class="form-control" row="10" cols="60" placeholder="コメント" id="comment"></textarea>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <select class="form-select" id="rate_input" style="width:80px;" >
                                <option value="1">☆1</option>
                                <option value="2">☆2</option>
                                <option value="3">☆3</option>
                                <option value="4">☆4</option>
                                <option value="5" selected="selected">☆5</option>
                            </select>
                            <button class="btn btn-outline-primary btn-sm" style="font-size:0.32rem; " onclick="commentCreate({{ $goods->id }})">投稿</button>
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
