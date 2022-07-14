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
        // var hotel_adult_price = document.getElementsByName('hotel_adult_price');
        // var hotel_child_price = document.getElementsByName('hotel_child_price');
        // var food_adult_price = document.getElementsByName('food_adult_price');
        // var food_child_price = document.getElementsByName('food_child_price');

        // alert (adult);
        // alert (child);
        // alert (adult_price.innerHTML);
        // alert (child_price.innerHTML);
        // alert (hotel_adult_price.innerHTML);
        // alert (hotel_child_price.innerHTML);
        // alert (food_adult_price.innerHTML);
        // alert (food_child_price.innerHTML);

        var adult_result;
        adult_result = (adult_price.innerHTML*adult);

        // alert(adult_result);

        var child_result;
        child_result = (child_price.innerHTML*child);

        // alert(child_result);

        price.innerHTML = "合計金額："+(adult_result + child_result)+"円";





    }


</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
<style>
    .card-img-overlay{
    padding: 0;
    top: calc(50% - 0.5rem);
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
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-9">
            <div class="card">
                <img class="card-img" style="height: 300px; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
                <div class="card-img-overlay">
                    <h4 class="bg-secondary text-white" style="--bs-bg-opacity: .5;" >{{ $experienceFolder->name }}</h4>
                </div>
                <div class="mt-4">
                    <div class="card-body">
                        <p>
                            この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                            この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                            この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                            この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                        </p>
                        <p class="pt-3 h5">体験料金の目安は{{ $experienceFolder->price }}円~</p>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-9">
            <form  action="{{ Request::url() }}" method="POST">
            @csrf
            <input hidden name="date" type="text" value="{{ $experienceFolder->is_before_lodging ?  (new DateTime(app('request')->input('keyword')))->modify("-1day")->format('Y-m-d') : app('request')->input('keyword') }}">

                <div class="mt-2 card bg-f-part text-white">

                    <div class="card-body">
                        <p class="fw-bold">体験日: {{ app('request')->input('keyword') }}</p>
                        <p class="fw-bold">{{ $experience->name }}</p>
                        {{-- <p class="fw-bold">日程: {{ $experience->start_date }}</p> --}}
                        <p> </p>
                        <p class="fw-bold">{{ $experienceFolder->is_lodging ? ('宿泊日: ' . ($experienceFolder->is_before_lodging ?  (new DateTime(app('request')->input('keyword')))->modify("-1day")->format('Y-m-d') . ' (前泊)' : app('request')->input('keyword') . ' (後泊)') ) : '宿泊なし' }}</p>
                        <div class="d-flex align-items-center fw-bold mb-2">
                            宿泊/体験人数：
                            <label for="quantity_adult">大人</label>
                            <select class="form-select form-select-sm me-1" style="width:64px" id="adult" name="quantity_adult" type="number" onchange="formSwitch()">
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
                            <label for="quantity_child">子ども</label>
                            <select class="form-select form-select-sm"style="width:64px" id="child" name="quantity_child" type="number" onchange="formSwitch()">
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
                        <p class="fw-bold">大人:<span id="adult_price" value=""> {{ $experience->price_adult }}</span>円 子ども:<span id="child_price" value="">{{ $experience->price_child }}</span> 円</p>
                        <p class="mb-0 fw-bold">宿泊プラン</p>
                        @forelse ($experienceFolder->hotelGroup as $hotelGroup)
                            <div class="fw-bold">
                                　<input type="radio" id="hotel_group_{{ $hotelGroup->id }}" name="hotel_group_id" value="{{ $hotelGroup->id }}">
                                <label for="{{ $hotelGroup->id }}">{{ $hotelGroup->name }}: 大人<span name='hotel_adult_price'>{{ $hotelGroup->price_adult }}</span>円 子ども<span  name='hotel_child_price'>{{ $hotelGroup->price_child }}</span>円</label>
                            </div>
                        @empty
                            <p class="fw-bold">この体験は宿泊がありません</p>
                        @endforelse
                        <p class="mb-0 fw-bold">食事プラン</p>
                        @forelse ($experienceFolder->foodGroup as $foodGroup)
                            <div>
                                　<input type="radio" id="food_group_{{ $foodGroup->id }}" name="food_group_id" value="{{ $foodGroup->id }}">
                                <label class="fw-bold" for="{{ $foodGroup->id }}">{{ $foodGroup->name }}: 大人<span  name='food_adult_price'>{{ $foodGroup->price_adult }}</span>円 子ども<span name='food_child_price'>{{ $foodGroup->price_child }}</span>円</label>
                            </div>
                        @empty
                            <p class="fw-bold">この体験は食事がつきません</p>
                        @endforelse
                        @if(!$experienceFolder->foodGroup->isEmpty())
                            <div class="fw-bold">
                                　<input type="radio" id="food_group_null" name="food_group_id" value="food_group_null">
                                <label for="food_group_null">食事なし</label>
                            </div>
                        @endempty
                        <p class="text-end"><span id="price"></span></p>
                    </div>

                </div>
                <div class="text-center text-md-end">
                        <button class="btn btn-pink btn-light m-2 text-center fw-bold rounded-pill shadow-sm fs-4" style="width:240px" type="submit" value="">
                            <i class="bi bi-cart"></i>カートに入れる
                        </button>
                </div>

                <!-- <div class="mt-2 card">
                    <div class="card-header">人数</div>
                    <div class="card-body">
                        <label for="quantity_adult">大人</label><input name="quantity_adult" type="number">
                        <label for="quantity_child">子ども</label><input name="quantity_child" type="number">
                    </div>
                </div>

                <div class="mt-2 card">
                    <div class="card-header">宿泊</div>
                    <div class="card-body">
                        @forelse ($experienceFolder->hotelGroup as $hotelGroup)
                            <div>
                                <input type="radio" id="hotel_group_{{ $hotelGroup->id }}" name="hotel_group_id" value="{{ $hotelGroup->id }}">
                                <label for="{{ $hotelGroup->id }}">{{ $hotelGroup->name }}: 大人{{ $hotelGroup->price_adult }}円 子ども{{ $hotelGroup->price_child }}円</label>
                            </div>
                        @empty
                            <p>この体験は宿泊がありません</p>
                        @endforelse
                    </div>
                </div>

                <div class="mt-2 card">
                    <div class="card-header">食事</div>
                    <div class="card-body">
                        @forelse ($experienceFolder->foodGroup as $foodGroup)
                            <div>
                                <input type="radio" id="food_group_{{ $foodGroup->id }}" name="food_group_id" value="{{ $foodGroup->id }}">
                                <label for="{{ $foodGroup->id }}">{{ $foodGroup->name }}: 大人{{ $foodGroup->price_adult }}円 子ども{{ $foodGroup->price_child }}円</label>
                            </div>
                        @empty
                            <p>この体験は食事がつきません</p>
                        @endforelse
                        @if(!$experienceFolder->foodGroup->isEmpty())
                            <div>
                                <input type="radio" id="food_group_null" name="food_group_id" value="food_group_null">
                                <label for="food_group_null">食事なし</label>
                            </div>
                        @endempty
                    </div>
                </div> -->

            </form>



        </div>
        <div class= "col-md-9">
             <div class="card mt-2">
                <!-- <div class="card-header">詳細</div> -->
                <div class="card-body">
                    <!-- <p>名前: {{ $experienceFolder->name }}</p>
                    <p>値段: {{ $experienceFolder->price }}円</p> -->
                    <p class="fw-bold h5">注意事項など</p>
                    <p>
                        この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                        この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                        この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                        この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                    </p>
                    <p></p>
                    <p class="mb-0">宿泊場所は観光協会お任せとなります。</p>
                    <p>決まり次第後ほど観光協会よりご連絡いたします。</p>
                    <!-- <p>開催日: {{ app('request')->input('keyword') }}</p>
                    <p>{{ $experienceFolder->is_lodging ? ('宿泊日: ' . app('request')->input('keyword'). ($experienceFolder->is_before_lodging ? ' (前泊)' : ' (後泊)') ) : '宿泊なし' }}</p> -->
                </div>
            </div>

        </div>


    </div>
</div>
<!-- <footer class="mt-4">
        <div class="bg-f-part py-3">
            <h2 class="text-center text-white mb-0">観光協会</h2>
        </div>
        <div class = "f-pink">
            <div class="d-flex py-4">
                <div class="d-flex flex-column ms-4">
                    <ul>
                        <li><a href="#" class="text-white">プログラム一覧</a></li>
                        <li><a href="#" class="text-white">商品一覧</a></li>
                        <li><a href="#" class="text-white">支払い方法</a></li>
                    </ul>
                </div>
                <div class="d-flex flex-column ms-4">
                    <ul>
                        <li><a href="#" class="text-white">キャンセル・返品について</a></li>
                        <li><a href="#" class="text-white">特定商取引に基づく表記</a></li>
                        <li><a href="#" class="text-white">プライバシーポリシー</a></li>
                    </ul>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <p class="text-white ps-4">Copyright© 観光協会 All rights reserved.</p>
                <p class="text-white pe-4"><small>Powered by URATABI</small></p>
            </div>
        </div>




    <footer> -->

@endsection
