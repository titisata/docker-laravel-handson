@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-9">
            <div class="card" style="height: 300px;">
                <img class="card-img" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
                <div class="card-img-overlay">
                    <h4 class="bg-secondary text-white" style="--bs-bg-opacity: .5;" >{{ $experienceFolder->name }}</h4>
                </div>
                
            </div>
            <form class="mb-3 mt-3" action="{{ Request::url() }}" method="POST">
            @csrf

                <div class="mt-2 card">
                    <div class="card-header">予約内容</div>
                    <div class="card-body">
                        <p>{{ $experience->name }}</p>
                        {{-- <p>日程: {{ $experience->start_date }}</p> --}}
                        <p>開催日: {{ app('request')->input('keyword') }}</p>
                        <p>{{ $experienceFolder->is_lodging ? ('宿泊日: ' . app('request')->input('keyword'). ($experienceFolder->is_before_lodging ? ' (前泊)' : ' (後泊)') ) : '宿泊なし' }}</p>
                        <p>大人: {{ $experience->price_adult }}円 子ども: {{ $experience->price_child }}円</p>
                    </div>
                </div>

                <div class="mt-2 card">
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
                </div>
                <input type="submit" value="カートに入れる">
            </form>
        </div>
    </div>
</div>

@endsection
