@extends('layouts.app')

@section('content')
<style>
    .card-img-overlay{
    padding: 0;
    top: calc(50% - 0.5rem);
    text-align: center;
    font-weight: bold;
}
.bg-f-part{
    background-color:#343a40;
}
.f-pink{
    background-color:#BB4156;
    
}
ul{
    list-style-type: none
}
a{
    text-decoration:none;
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
            <form class="mb-3" action="{{ Request::url() }}" method="POST">
            @csrf

                <div class="mt-2 card bg-f-part text-white">
                    
                    <div class="card-body">
                        <p class="fw-bold">体験日: {{ app('request')->input('keyword') }}</p>
                        <p class="fw-bold">{{ $experience->name }}</p>
                        {{-- <p class="fw-bold">日程: {{ $experience->start_date }}</p> --}}      
                        <p class="fw-bold">{{ $experienceFolder->is_lodging ? ('宿泊日: ' . app('request')->input('keyword'). ($experienceFolder->is_before_lodging ? ' (前泊)' : ' (後泊)') ) : '宿泊なし' }}</p>
                        <div class="d-flex align-items-center fw-bold mb-2">
                            宿泊/体験人数：
                            <label for="quantity_adult">大人</label><input class="form-control form-control-sm" style="width:64px" name="quantity_adult" type="number">
                            <label for="quantity_child">子ども</label><input class="form-control form-control-sm"style="width:64px"  name="quantity_child" type="number">
                        </div>
                        <p class="fw-bold">大人: {{ $experience->price_adult }}円 子ども: {{ $experience->price_child }}円</p>
                        @forelse ($experienceFolder->hotelGroup as $hotelGroup)
                            <div class="fw-bold">
                                <p class="mb-0">宿泊プラン</p>
                                <input type="radio" id="hotel_group_{{ $hotelGroup->id }}" name="hotel_group_id" value="{{ $hotelGroup->id }}">
                                <label for="{{ $hotelGroup->id }}">{{ $hotelGroup->name }}: 大人{{ $hotelGroup->price_adult }}円 子ども{{ $hotelGroup->price_child }}円</label>
                            </div>
                        @empty
                            <p class="fw-bold">この体験は宿泊がありません</p>
                        @endforelse
                        @forelse ($experienceFolder->foodGroup as $foodGroup)
                            <div>
                                <p class="mb-0">食事プラン</p>
                                <input type="radio" id="food_group_{{ $foodGroup->id }}" name="food_group_id" value="{{ $foodGroup->id }}">
                                <label class="fw-bold" for="{{ $foodGroup->id }}">{{ $foodGroup->name }}: 大人{{ $foodGroup->price_adult }}円 子ども{{ $foodGroup->price_child }}円</label>
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
                    </div>
                    <div class="ms-auto">
                        <input class="btn btn-light m-2 text-end" style="width:120px" type="submit" value="カートに入れる">
                    </div>
                    
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
             <div class="card mt-4">
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
<footer class="mt-4">
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
        
        

        
    <footer>

@endsection
