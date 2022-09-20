@extends('layouts.app')

@section('content')
<script>

   var adult_num = 0;
   var child_num = 0;

   var hotel_adult_price_value = 0;
   var hotel_child_price_value = 0;

   var food_adult_price_value = 0;
   var food_child_price_value = 0;

   function radiohotelSwitch(){
    const formElements = document.forms.reserve_form;

    var attribute = formElements.hotel_group_id.value;

    var get_hotel_adult = 'hotel_adult_price_' + attribute;
    var get_hotel_child = 'hotel_child_price_' + attribute;

    var hotel_adult_price = document.getElementById(get_hotel_adult);
    var hotel_child_price = document.getElementById(get_hotel_child);

    hotel_adult_price_value = parseInt(hotel_adult_price.getAttribute('value'));
    hotel_child_price_value = parseInt(hotel_child_price.getAttribute('value'));
    
    price_result();

   }

   function radiofoodSwitch(){
    const formElements = document.forms.reserve_form;

    var attribute = formElements.food_group_id.value;

    if(attribute != 0){
        var get_food_adult = 'food_adult_price_' + attribute;
        var get_food_child = 'food_child_price_' + attribute;

        var food_adult_price = document.getElementById(get_food_adult);
        var food_child_price = document.getElementById(get_food_child);

        food_adult_price_value = parseInt(food_adult_price.getAttribute('value'));
        food_child_price_value = parseInt(food_child_price.getAttribute('value'));
    }else{
        food_adult_price_value = 0;
        food_child_price_value = 0;
        
    }

    price_result();
   }

   function price_result(){
      adult_price = document.getElementById('adult_price');
      var adult_price_value = parseInt(adult_price.getAttribute('value'));
      child_price = document.getElementById('child_price');
      var child_price_value = parseInt(child_price.getAttribute('value'));
      adult_num = parseInt(document.getElementById('adult').value);
      child_num = parseInt(document.getElementById('child').value);
      var adult_price_result = adult_num*(adult_price_value + hotel_adult_price_value + food_adult_price_value); 
      var child_price_result = child_num*(child_price_value + hotel_child_price_value + food_child_price_value);
      var price_result = adult_price_result + child_price_result;
      document.getElementById('price').innerHTML = price_result.toLocaleString();
  
   }


   

    function check(){
        var flag = 0;
          var msg = "入力エラー";

        var price = document.getElementById('price');
        if(price.innerHTML == '0' ){
            flag = 1;
            msg = msg + "\n人数が選択されていません";
        }

        if(flag == 1){
              alert(msg);
              return false;
          }else{
               return true;
              }


    }


</script>
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
    top: calc(80% - 0.5rem);
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
input[type="radio"] {
    height:16px;
    width:16px;
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

.small_font{
    font-size:12px;
}

@media screen and (max-width: 320px) {
    input[type="radio"] {
    height:24px;
    width:24px;
    }

}


</style>
<div class="card" style="height: 400px;">
    <img class="card-img" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="">             
</div>
<div class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-md-11">
            <div class="d-flex flex-wrap justify-content-between">
                <ul class="horizontal-list ps-0" >
                    @foreach($experienceFolder->images() as $image)
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

            

            <div class="mt-4">
                    <div class="card-body p-0">
                        <h3 class="fw-bold text-gray py-auto mb-0" style="--bs-bg-opacity: .10;" >{{ $experienceFolder->name }}</h3>
                        @if($experienceFolder->average_rate < 1.5)
                            <p class="mb-0">テスト用に表示、0は表示しないようにする</p>
                            <div class="d-flex mb-3">
                                <img src="/images/star1.png" style="width:120px;height35px">
                            </div>
                        @elseif($experienceFolder->average_rate < 2)
                            <div class="d-flex mb-3">
                            <img src="/images/star1.5.png" style="width:120px;height35px">
                            </div>
                        @elseif($experienceFolder->average_rate < 2.5)
                            <div class="d-flex mb-3">
                            <img src="/images/star2.png" style="width:120px;height35px">
                            </div>
                        @elseif($experienceFolder->average_rate < 3)
                            <div class="d-flex mb-3">
                            <img src="/images/star2.5.png" style="width:120px;height35px">
                            </div>
                        @elseif($experienceFolder->average_rate < 3.5)
                            <div class="d-flex mb-3">
                            
                            <img src="/images/star3.png" style="width:120px;height35px">
                            </div>
                        @elseif($experienceFolder->average_rate < 4)
                            <div class="d-flex mb-3">
                            
                            <img src="/images/star3.5.png" style="width:120px;height35px">
                            </div>
                        @elseif($experienceFolder->average_rate < 4.5)
                            <div class="d-flex mb-3">
                            
                            <img src="/images/star4.png" style="width:120px;height35px">
                            </div>
                        @elseif($experienceFolder->average_rate < 5)
                            <div class="d-flex mb-3">
                            
                            <img src="/images/star4.5.png" style="width:120px;height35px">
                            </div>
                        @elseif($experienceFolder->average_rate = 5)
                            <div class="d-flex mb-3">
                            
                            <img src="/images/star5.png" style="width:120px;height35px">
                            </div>
                        @endif
                        <p class="text-gray fs-5 mt-4">{{ $experienceFolder->description }}</p>
                        
                    </div>
                    <p class="mb-4 text-start"><a role="button" href="/partner/{{ $experienceFolder->user_id }}" class="btn btn-outline-secondary rounded-pill">会社情報</a></p>
                </div>

        </div>
        <div class="col-md-10">
            <form action="{{ Request::url() }}" method="POST" name="reserve_form" onsubmit='return check();'>
            @csrf
            <input type="hidden" name="user_id" value="{{ $experienceFolder->user_id }}">
            <input hidden name="date" type="text" value="{{ $experienceFolder->is_before_lodging ?  (new DateTime(app('request')->input('keyword')))->modify("-1day")->format('Y-m-d') : app('request')->input('keyword') }}">

                <div class="mt-2 card shadow-sm bg-color text-more-gray">

                    <div class="card-body">
                        <div class="pt-3">
                            <div class="">
                                <div class="d-flex">
                                    <p class="fs-4">体験日 : <span class="fw-bold">{{ app('request')->input('keyword') }}</span></p>
                                    <p class="ms-4 fs-4 fw-bold mb-0">{{ $experience->name }}</p>
                                    
                                </div>
                                @if( $experienceFolder->is_lodging == 1)
                                <p class="fs-4 mb-3 ">宿泊日 : <span class="fw-bold"> {{ $experienceFolder->is_lodging ? (($experienceFolder->is_before_lodging ?  (new DateTime(app('request')->input('keyword')))->modify("-1day")->format('Y-m-d') . ' (前泊)' : app('request')->input('keyword') . ' (後泊)') ) : '宿泊はありません' }}</span></p>
                                @endif
                            </div>
                            
                        </div>

                        <div class="d-flex align-items-center mb-2 pb-2 fs-4">
                            @if( $experienceFolder->is_lodging == 1)
                                宿泊・体験人数　
                            @else
                                体験人数　
                            @endif
                            <div class="d-flex flex-wrap align-items-center">
                                <label for="quantity_adult">大人 </label>
                                <select class="form-select form-select-sm me-1 ms-2 fs-5" style="width:80px" id="adult" name="quantity_adult"  onchange="price_result()">
                                    <option selected="0">0</option>
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
                            <div class="d-flex flex-wrap align-items-center">
                                <label for="quantity_child" class="ms-3">子ども </label>
                                <select class="form-select form-select-sm ms-2 fs-5" style="width:80px" id="child" name="quantity_child" onchange="price_result()">
                                    <option selected="0">0</option>
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

                        <div class="d-flex border-bottom border-secondary fs-4 pb-4">
                            <p class="mb-0">体験料金　</p>
                            <div class="d-flex flex-column flex-lg-row">
                                <p class="mb-1 mb-lg-0">大人 : <span class="small small_font ">税込</span><span id="adult_price" value="{{ $experience->price_adult }}" class="fw-bold">{{  number_format($experience->price_adult) }}</span><span class="small small_font">円 / 人</span></p>
                                <p class="ms-lg-3  mb-0">子ども : <span class="small small_font">税込</span><span id="child_price" value="{{ $experience->price_child }}" class="fw-bold">{{  number_format($experience->price_child) }}</span><span class="small small_font">円 / 人</span></p>
                            </div>
                        </div>

                        <p class="mb-0 pt-4 fs-4">宿泊プラン</p>
                        <div class="mb-2 fs-4">
                            @forelse ($experienceFolder->hotelgroups as $hotelgroup)
                            <div class="form-check my-2">
                                <input class="form-check-input" type="radio" id="hotel_group_{{ $hotelgroup->id }}" name="hotel_group_id" value="{{ $hotelgroup->id }}" onchange="radiohotelSwitch()">
                                <label class="form-check-label" for="hotel_group_{{ $hotelgroup->id }}">
                                    {{ $hotelgroup->name }} : 
                                    大人<span class="small small_font ms-1">税込</span><span id='hotel_adult_price_{{ $hotelgroup->id }}' value="{{ $hotelgroup->price_adult }}" class="fw-bold">{{ number_format($hotelgroup->price_adult) }}</span><span class="small small_font">円 / 人</span>　
                                    子ども<span class="small small_font ms-1">税込</span><span id='hotel_child_price_{{ $hotelgroup->id }}' value="{{ $hotelgroup->price_child }}" class="fw-bold">{{ number_format($hotelgroup->price_child) }}</span><span class="small small_font">円 / 人</span>
                                </label>
                            </div>    
                            @empty
                                <p class="">この体験は宿泊がありません</p>
                            @endforelse
                        </div>

                        <p class="mb-0 fs-4 mt-4 ">食事プラン</p>
                        <div class=" fs-4 pb-4">
                            @forelse ($experienceFolder->foodgroups as $foodgroup)
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="radio" id="food_group_{{ $foodgroup->id }}" name="food_group_id" value="{{ $foodgroup->id }}" onchange="radiofoodSwitch()">
                                    <label class="form-check-label" for="food_group_{{ $foodgroup->id }}">
                                        {{ $foodgroup->name }} :  
                                        大人<span class="small small_font ms-1">税込</span><span id='food_adult_price_{{ $foodgroup->id }}' value='{{ $foodgroup->price_adult }}' class="fw-bold">{{ number_format($foodgroup->price_adult) }}</span><span class="small small_font">円 / 人</span>　
                                        子ども<span class="small small_font ms-1">税込</span><span id='food_child_price_{{ $foodgroup->id }}' class="fw-bold" value='{{ $foodgroup->price_child }}'>{{ number_format($foodgroup->price_child) }}</span><span class="small small_font">円 / 人</span>
                                    </label>
                                </div>
                            @empty
                                <p class="">この体験は宿泊がありません</p>
                            @endforelse
                            
                        </div>

                        <p class="text-end border-top border-secondary pt-3 fs-3 mb-0 ">合計金額：<span class="small small_font ms-1">税込</span><span id="price" class="fs-3">0</span><span class="small small_font">円</span></p>
                    </div>

                </div>

                <div class="mt-2 card shadow-sm bg-color text-more-gray">

                    <div class="card-body">
                        <p class="fs-4">体験施設・宿泊施設等への連絡事項</p>
                        <div>
                            <textarea class="form-control" name="message" row="10" cols="60" placeholder="アレルギーなど知らせておきたいことや、質問事項等あればご記入ください。" id="comment"></textarea>
                        </div>

                    </div>

                </div>
                
                @if($experienceFolder->status == 1 && $experience->status == 1)
                    <div class="text-center text-md-end mt-3">
                        <button class="btn btn-pink btn-light m-2 text-center fw-bold rounded-pill shadow-sm fs-4 col-8 col-lg-4"  type="submit" value="">
                            <i class="bi bi-cart"></i>カートに入れる
                        </button>
                    </div>
                @else
                    <div class="text-center pt-3">
                        <p class="text-danger">現在この商品は扱っておりません</p>
                    </div>
                
                @endif



            </form>



        </div>
        <div class= "col-md-10">
            <div class="mt-4">

                <p class="fw-bold fs-5 text-gray">注意事項など</p>
                <p class="text-gray">{{ $experienceFolder->caution }}</p>
                <p></p>
                <p class="mb-0 text-gray">宿泊場所は観光協会お任せとなります。</p>
                <p class="text-gray">決まり次第後ほど観光協会よりご連絡いたします。</p>

            </div>

        </div>

         <div class="mt-5 card col-md-10">

                        <div class="d-flex flex-column">
                            <h4 class="m-3 fw-bold">クチコミ</h4>

                                @if($experienceFolder->average_rate < 1.5)
                                    <p class="mb-0 ms-3">テスト用に表示、0は表示しないようにする</p>
                                    <div class="d-flex align-items-center ms-3">
                                        <p class="mb-0 fs-2 fw-bold">{{ $experienceFolder->average_rate }}</p>
                                        <img src="/images/star1.png" style="width:120px;height35px">
                                    </div>
                                @elseif($experienceFolder->average_rate < 2)
                                    <div class="d-flex align-items-center ms-3">
                                    <p class="mb-0 fs-2 fw-bold">{{ $experienceFolder->average_rate }}</p>
                                    <img src="/images/star1.5.png" style="width:120px;height35px">
                                    </div>
                                @elseif($experienceFolder->average_rate < 2.5)
                                    <div class="d-flex align-items-center ms-3">
                                    <p class="mb-0 fs-2 fw-bold">{{ $experienceFolder->average_rate }}</p>
                                    <img src="/images/star2.png" style="width:120px;height35px">
                                    </div>
                                @elseif($experienceFolder->average_rate < 3)
                                    <div class="d-flex align-items-center ms-3">
                                    <p class="mb-0 fs-2 fw-bold">{{ $experienceFolder->average_rate }}</p>
                                    <img src="/images/star2.5.png" style="width:120px;height35px">
                                    </div>
                                @elseif($experienceFolder->average_rate < 3.5)
                                    <div class="d-flex align-items-center ms-3">
                                    <p class="mb-0 fs-2 fw-bold">{{ $experienceFolder->average_rate }}</p>
                                    <img src="/images/star3.png" style="width:120px;height35px">
                                    </div>
                                @elseif($experienceFolder->average_rate < 4)
                                    <div class="d-flex align-items-center ms-3">
                                    <p class="mb-0 fs-2 fw-bold">{{ $experienceFolder->average_rate }}</p>
                                    <img src="/images/star3.5.png" style="width:120px;height35px">
                                    </div>
                                @elseif($experienceFolder->average_rate < 4.5)
                                    <div class="d-flex align-items-center ms-3">
                                    <p class="mb-0 fs-2 fw-bold">{{ $experienceFolder->average_rate }}</p>
                                    <img src="/images/star4.png" style="width:120px;height35px">
                                    </div>
                                @elseif($experienceFolder->average_rate < 5)
                                    <div class="d-flex align-items-center ms-3">
                                    <p class="mb-0 fs-2 fw-bold">{{ $experienceFolder->average_rate }}</p>
                                    <img src="/images/star4.5.png" style="width:120px;height35px">
                                    </div>
                                @elseif($experienceFolder->average_rate = 5)
                                    <div class="d-flex align-items-center ms-3">
                                    <p class="mb-0 fs-2 fw-bold">{{ $experienceFolder->average_rate }}</p>
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
                                            <button class="btn btn-outline-primary"  onclick="commentCreate({{ $experienceFolder->id }})">投稿</button>
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


@endsection
