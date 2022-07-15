@extends('layouts.app')

@section('content')
<style>
.card-img-overlay{
    padding: 0;
    top: calc(90% - 0.5rem);
    text-align: center;
    font-weight: bold;
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
                <div class="card-img-overlay">
                    <h3 class="bg-secondary text-white" style="--bs-bg-opacity: .5;" >{{ $goods->name }}</h3>
                </div>
            </div>

            <form class="mb-3 mt-3" action="{{ Request::url() }}" method="POST">
                        @csrf
                <div class="card mt-4">
                
                    <div class="card-body">
                        
                        <p class="fw-bold h4"> {{ $goods->name }}</p>
                        <p>
                        {{ $goods->description }}
                        </p>
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
                            

                    </div>
                    
                </div> 
                <div class="text-end mt-2">
                        <input type="submit" class="btn btn-primary" href="" value="カートに入れる">
                </div>
            </form>
            

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
                <div class="card-header">口コミ</div>

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
