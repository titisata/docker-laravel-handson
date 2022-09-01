@extends('layouts.app')

@section('content')
<script>
    // var adult = document.getElementById('adult').value;
    // var child = document.getElementById('child').value;



    function formSwitch(){
        var price = document.getElementById('price');
        var adult = document.getElementById('adult').value;
        var child = document.getElementById('child').value;
        var adult_price = document.getElementById('adult_price');
        var child_price = document.getElementById('child_price');

        // @foreach ($experienceFolder->hotelGroup as $hotelGroup)
        //     var hotel_adult_prices_{{ $hotelGroup->id }} = document.getElementById('hotel_adult_prices_{{ $hotelGroup->id }}').value;
        // @endforeach


        // var hotel_adult_prices = document.getElementsByClassName('hotel_adult_price');
        // var hotel_child_price = document.getElementsByClassName('hotel_child_price');
        // var food_adult_price = document.getElementsByName('food_adult_price');
        // var food_child_price = document.getElementsByName('food_child_price');

        // for (const hotel_adult_price of hotel_adult_prices) {
        //  alert(hotel_adult_price);
        // }

        // alert (hotel_child_price.innerHTML);
        // alert (food_adult_price.innerHTML);
        // alert (food_child_price.innerHTML);

        var adult_result;
        adult_result = (adult_price.innerHTML*adult);

        var child_result;
        child_result = (child_price.innerHTML*child);

        // var adult_hotel_price;
        // adult_hotel_price = (hotel_adult_prices_{{ $hotelGroup->id }}.innerHTML*child);

        // alert(child_result);

        price.innerHTML = (adult_result + child_result);





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

@media screen and (max-width: 320px) {
    input[type="radio"] {
    height:24px;
    width:24px;
    }

}


</style>
<div class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-md-9">

            <div class="card" style="height: 300px;">
                <img class="card-img" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="">
                <div class="card-img-overlay d-flex align-items-center justify-content-center" style="background: linear-gradient(rgba(0,0,0,0),rgb(125, 209, 52));height:68px;">
                    <h3 class="fw-bold text-white py-auto" style="--bs-bg-opacity: .10;" >{{ $experienceFolder->name }}</h3>
                </div>
            </div>

            <div class="mt-4">
                    <div class="card-body">
                        <p class="">{{ $experienceFolder->description }}</p>
                        <p class="pt-3 fs-5 text-end">体験料金の目安は{{ $experienceFolder->price_child }}円~</p>
                        <p class="mb-4 text-end"><a role="button" href="/partner/{{ $experienceFolder->partner->id }}" class="btn btn-outline-secondary rounded-pill">会社情報</a></p>
                    </div>
                </div>

        </div>
        <div class="col-md-9">
            <form  action="{{ Request::url() }}" method="POST" onsubmit='return check();'>
            @csrf
            <input hidden name="date" type="text" value="{{ $experienceFolder->is_before_lodging ?  (new DateTime(app('request')->input('keyword')))->modify("-1day")->format('Y-m-d') : app('request')->input('keyword') }}">

                <div class="mt-2 card shadow-sm bg-f-part text-white">

                    <div class="card-body">
                        <div class="border-bottom border-secondary">
                            <div class="d-flex">
                                <p class="fs-5">体験日: {{ app('request')->input('keyword') }}</p>
                                <p class="ms-4 fs-5">{{ $experience->name }}</p>
                            </div>
                            <p class="fs-5">{{ $experienceFolder->is_lodging ? ('宿泊日: ' . ($experienceFolder->is_before_lodging ?  (new DateTime(app('request')->input('keyword')))->modify("-1day")->format('Y-m-d') . ' (前泊)' : app('request')->input('keyword') . ' (後泊)') ) : '宿泊なし' }}</p>
                        </div>

                        <div class="d-flex align-items-center mb-2 pt-3 pb-2 fs-5">
                            宿泊/体験人数　
                            <div class="d-flex flex-wrap">
                                <label for="quantity_adult">大人 </label>
                                <select class="form-select form-select-sm me-1" style="width:64px" id="adult" name="quantity_adult"  onchange="formSwitch()">
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
                            <div class="d-flex flex-wrap">
                                <label for="quantity_child" class="ms-1">子ども </label>
                                <select class="form-select form-select-sm"style="width:64px" id="child" name="quantity_child" onchange="formSwitch()">
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

                        <div class="d-flex border-bottom border-secondary fs-5">
                            <p class="me-3">プラン料金</p>
                            <div class="d-flex flex-column">
                                <p class="mb-1">　大人 : <span id="adult_price" value="">{{ $experience->price_adult }}</span>円/人</p>
                                <p class="">子ども : <span id="child_price" value="">{{ $experience->price_child }}</span>円/人</p>
                            </div>
                        </div>

                        <p class="mb-0 pt-3 fs-5">宿泊プラン</p>
                        <div class="mb-2 fs-5">
                            @forelse ($experienceFolder->hotelGroup as $hotelGroup)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="hotel_group_{{ $hotelGroup->id }}" name="hotel_group_id" value="{{ $hotelGroup->id }}">
                                    <label class="form-check-label" for="hotel_group_{{ $hotelGroup->id }}">
                                        {{ $hotelGroup->name }}: 
                                        大人<span id='hotel_adult_price_{{ $hotelGroup->id }}' value="{{ $hotelGroup->price_adult }}">{{ $hotelGroup->price_adult }}</span>円　
                                        子ども<span class='hotel_child_price_{{ $hotelGroup->id }}' value="{{ $hotelGroup->price_child }}">>{{ $hotelGroup->price_child }}</span>円
                                    </label>
                                </div>
                            @empty
                                <p class="">この体験は宿泊がありません</p>
                            @endforelse
                        </div>

                        <p class="mb-0 fs-5">食事プラン</p>
                        <div class="mb-3 fs-5">
                            @forelse ($experienceFolder->foodGroup as $foodGroup)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="food_group_{{ $foodGroup->id }}" name="food_group_id" value="{{ $foodGroup->id }}">
                                    <label class="form-check-label" for="food_group_{{ $foodGroup->id }}">
                                        {{ $foodGroup->name }}: 
                                        大人<span  name='food_adult_price'>{{ $foodGroup->price_adult }}</span>円　
                                        子ども<span name='food_child_price'>{{ $foodGroup->price_child }}</span>円
                                    </label>
                                </div>
                            @empty
                                <p class="">この体験は食事がつきません</p>
                            @endforelse
                            @if(!$experienceFolder->foodGroup->isEmpty())
                                <div class="form-check">
                                    <input class="form-check-input"  type="radio" id="food_group_null" name="food_group_id" value="food_group_null">
                                    <label class="form-check-label" for="food_group_null">食事なし</label>
                                </div>
                            @endempty
                        </div>

                        <p class="text-end border-top border-secondary pt-3 fs-5 mb-0">合計金額：<span id="price" class="fs-5">0</span>円</p>
                    </div>

                </div>

                <div class="mt-2 card shadow-sm bg-f-part text-white">

                    <div class="card-body">
                        <p class="fs-5">体験施設・宿泊施設等への連絡事項</p>
                        <p class="mb-0">コメント</p>
                        <div>
                            <textarea class="form-control" name="message" row="10" cols="60" placeholder="アレルギーなど知らせておきたいことや、質問事項等あればご記入ください。" id="comment"></textarea>
                        </div>

                    </div>

                </div>
                <div class="text-center text-md-end mt-3">
                        <button class="btn btn-pink btn-light m-2 text-center fw-bold rounded-pill shadow-sm fs-4 col-8 col-lg-4"  type="submit" value="">
                            <i class="bi bi-cart"></i>カートに入れる
                        </button>
                </div>



            </form>



        </div>
        <div class= "col-md-9">
            <div class="mt-4">

                <p class="fw-bold fs-5">注意事項など</p>
                <p>{{ $experienceFolder->caution }}</p>
                <p></p>
                <p class="mb-0">宿泊場所は観光協会お任せとなります。</p>
                <p>決まり次第後ほど観光協会よりご連絡いたします。</p>

            </div>

        </div>


    </div>
</div>


@endsection
