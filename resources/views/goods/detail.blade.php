@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
<style>
ul.horizontal-list {
    overflow-x: auto;
    white-space: nowrap;
}
li.item {
	display: inline-block;
}
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
.text-gray{
    color:#6f6e6f;
}
.text-more-gray{
    color:#494645;
}
.bg-color{
    background-color:#f4f4f4;
}
.pink{
    color:#BB4156;
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

    function number_check(){
        
        var item_count = document.getElementById('item_count').value;
        var result = '';

        for(var i = 0; i < item_count; i++){
            var check = document.getElementsByName('quantity[]')[i];
            var set = parseInt(check.options[check.selectedIndex].value); 
            result += set;
        };

        document.getElementById('result').value = result;
        console.log(result);
       
    }
   
    function goods_formSwitch(id,value)
    {
        var goods_result = document.getElementById(`goods_result_${id}`);
        var goods_price = document.getElementById(`goods_price_${id}`);
        var count = document.getElementById(`count_${id}`).value;
        var count_ex = document.getElementById(`quantity_ex_${id}`).value;
        var before_count = document.getElementById(`before_count_${id}`).value;

        if(count > count_ex){
            alert('上限を超えています');
            document.getElementById(`count_${id}`).value = before_count;
            return false;
        }else{
            document.getElementById(`before_count_${id}`).value = value;
        }
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

var num = 0;

function submit_favorite(){
    document.favorite_form.submit();
    
    var h = document.getElementById('favorite');

    if(num % 2 === 0 ){
        h.className += ' text-secondary';
    }else{  
        h.classList.remove('text-secondary');
    }
    num++;
    


    return false
}

function submit_not_favorite(){
    document.favorite_form.submit();
    
    var n = document.getElementById('not_favorite');
   
    if(num % 2 === 0 ){
        n.className += ' pink';
    }else{
        
        n.classList.remove('pink');
    }
    num++;

    return false
}
</script>


<div class="card" style="height: 400px;">
    <img class="card-img img-thumbnail" style="height: 100%; object-fit: cover;" src="{{ $goods_folder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="">
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-11">
            
            <div class="d-flex flex-wrap justify-content-between">
                <ul class="horizontal-list ps-0" >
                    @foreach($goods_folder->images() as $image)
                        <li class="item mx-2">
                            <a role="button" data-bs-toggle="modal" data-bs-target="#modal{{ $image->id }}" class="mt-5" style="width:30%;">
                                <img class="card-img" style="width:140px; height: 140px; object-fit: cover;" src="{{ $image->image_path }}" alt="">
                            </a>
                            <div class="modal fade" id="modal{{ $image->id }}" tabindex="-1" aria-labelledby="ModalLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content ">
                                        <div class="modal-body">
                                            <img class="card-img" style="width:100%; object-fit: cover;" src="{{ $image->image_path }}" alt="">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">閉じる</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>    
                    @endforeach
                </ul>    
            </div>

            @if( $user!=null )
                <div class="d-flex my-3">
                    <h3 class="fw-bold text-gray">商品名：</h3>
                    <h3 class="fw-bold text-gray"> {{ $goods_folder->name }}</h3>
                    <div class="ms-3" >
                        @if(!empty($favorite))
                            <i id="favorite" class="bi bi-heart-fill pink fs-3" onclick="submit_favorite();"></i>
                        @else
                            <i id="not_favorite" class="bi bi-heart-fill text-gray fs-3" onclick="submit_not_favorite();"></i>
                        @endif
                    </div>
                </div>

                <form name="favorite_form" action="/favorite_edit" method="POST" target="sendFavorite">
                    @csrf
                    <input type="hidden" name="f_user_id" value="{{ $user->id }}">
                    <input type="hidden" name="f_experienceFolder_id" value="{{ $goods_folder->id }}">
                    <input type="hidden" name="f_table_name" value="goods_folders">
                </form>

                <iframe name="sendFavorite" style="width:0px;height:0px;border:0px;"></iframe>
            @else    
                <div class="d-flex my-3">
                    <h3 class="fw-bold text-gray">商品名：</h3>
                    <h3 class="fw-bold text-gray"> {{ $goods_folder->name }}</h3>
                </div>
            @endif
                <p class="text-gray fs-5">{!!nl2br(e($goods_folder->description))!!}</p>
                <p class="mb-4 text-start"><a role="button" href="/partner/{{ $goods_folder->user_id }}" class="btn btn-outline-secondary rounded-pill">会社情報</a></p>
                
                <form class="mb-3 col-md-6 offset-md-3" action="{{ Request::url() }}" method="POST" onsubmit='return check();'> 
                <?php $item_count=0; ?>  

                @error('result')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                
                @forelse($goods_folder->active_goods as $goods)
                    <?php $item_count++; ?>
                    <div class="card bg-color text-more-gray mt-3 p-3">
                        @csrf
                        <input type="hidden" name="goods_id[]" value="{{ $goods->id }}">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold">{{ $goods->name }}</h5>   
                            <p class="fw-bold text-end h3"><span class="small fw-normal me-1" style="font-size:12px;">送料・税込</span><span id="goods_price_{{ $goods->id }}">{{ $goods->price }}</span>円/個</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-end pb-4 border-bottom border-secondary">
                            <label class="fs-5 me-1" for="quantity">数量</label>
                            <div class="d-flex">
                                <select class="form-select form-select-sm me-1" style="width:64px" name="quantity[]" id="count_{{ $goods->id }}" onchange="goods_formSwitch('{{ $goods->id }}',this.value);number_check()">
                                    <option value="0">0</option>
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
                                <label class="fs-5 me-1" for="quantity_ex">（残り{{ $goods->quantity}}個）</label>
                                <input type='hidden' id="quantity_ex_{{ $goods->id }}" value="{{ $goods->quantity}}">
                                <input type='hidden' id="before_count_{{ $goods->id }}" value="0">
                                <!-- <input type="number" name="quantity[]" id="count_{{ $goods->id }}" onchange="goods_formSwitch('{{ $goods->id }}')"> -->
                            </div>    
                        </div> 
                        
                        <p class="text-end pt-3 fs-4 fw-bold ">合計金額：<span id="goods_result_{{ $goods->id }}" class="fs-4">0</span>円</p>

                    </div> 
                @empty
                    <p>商品がありません</p>
                @endforelse
                @if($goods_folder->status == 1)
                    <div class="text-center pt-3">
                        <button class="btn btn-pink btn-light m-2 text-center fw-bold rounded-pill shadow-sm fs-4 col-10 col-lg-10"  type="submit" value="">
                            <i class="bi bi-cart"></i>カートに入れる
                        </button>
                    </div>
                @else
                    <div class="text-center pt-3">
                        <p class="text-danger">現在この商品は扱っておりません</p>
                    </div> 
                @endif
                <input type="hidden" name="user_id" value="{{ $goods_folder->user_id }}">
                <input type="hidden" name="item_count" id="item_count" value="<?php echo $item_count; ?>">
                <input type="hidden" id="result" name="result" value="0">
                </form>
            <div class="my-5">
                <h5 class="mb-0 fw-bold text-gray">商品説明</h5>
                
                <p class="text-gray fs-5">{!!nl2br(e($goods_folder->detail))!!}</p>

            </div>
            <div class="my-5">
                <h5 class="mb-0 fw-bold text-gray">注意事項など</h5>
                
                <p class="text-gray fs-5">{!!nl2br(e($goods_folder->caution))!!}</p>

            </div>
            

            <div class="mt-2 card">
                <div class="d-flex flex-column">
                    <h4 class="m-3 fw-bold">クチコミ</h4>
                        @if($goods_folder->average_rate < 1.5)
                            <p class="mb-0 ms-3">テスト用に表示、0は表示しないようにする</p>
                            <div class="d-flex align-items-center ms-3">
                                <p class="mb-0 fs-2 fw-bold">{{ $goods_folder->average_rate }}</p>
                                <img src="/images/star1.png" style="width:120px;height35px">
                            </div>
                        @elseif($goods_folder->average_rate < 2)
                            <div class="d-flex align-items-center ms-3">
                            <p class="mb-0 fs-2 fw-bold">{{ $goods_folder->average_rate }}</p>
                            <img src="/images/star1.5.png" style="width:120px;height35px">
                            </div>
                        @elseif($goods_folder->average_rate < 2.5)
                            <div class="d-flex align-items-center ms-3">
                            <p class="mb-0 fs-2 fw-bold">{{ $goods_folder->average_rate }}</p>
                            <img src="/images/star2.png" style="width:120px;height35px">
                            </div>
                        @elseif($goods_folder->average_rate < 3)
                            <div class="d-flex align-items-center ms-3">
                            <p class="mb-0 fs-2 fw-bold">{{ $goods_folder->average_rate }}</p>
                            <img src="/images/star2.5.png" style="width:120px;height35px">
                            </div>
                        @elseif($goods_folder->average_rate < 3.5)
                            <div class="d-flex align-items-center ms-3">
                            <p class="mb-0 fs-2 fw-bold">{{ $goods_folder->average_rate }}</p>
                            <img src="/images/star3.png" style="width:120px;height35px">
                            </div>
                        @elseif($goods_folder->average_rate < 4)
                            <div class="d-flex align-items-center ms-3">
                            <p class="mb-0 fs-2 fw-bold">{{ $goods_folder->average_rate }}</p>
                            <img src="/images/star3.5.png" style="width:120px;height35px">
                            </div>
                        @elseif($goods_folder->average_rate < 4.5)
                            <div class="d-flex align-items-center ms-3">
                            <p class="mb-0 fs-2 fw-bold">{{ $goods_folder->average_rate }}</p>
                            <img src="/images/star4.png" style="width:120px;height35px">
                            </div>
                        @elseif($goods_folder->average_rate < 5)
                            <div class="d-flex align-items-center ms-3">
                            <p class="mb-0 fs-2 fw-bold">{{ $goods_folder->average_rate }}</p>
                            <img src="/images/star4.5.png" style="width:120px;height35px">
                            </div>
                        @elseif($goods_folder->average_rate = 5)
                            <div class="d-flex align-items-center ms-3">
                            <p class="mb-0 fs-2 fw-bold">{{ $goods_folder->average_rate }}</p>
                            <img src="/images/star5.png" style="width:120px;height35px">
                            </div>
                        @endif
            
                @if( $mycomment == null )
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
                @else
                    <div class="m-3">
                        <p>投稿済みです</p>
                    </div>

                @endif    
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
