@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-3">{{ $experienceFolder->name }}の予約</h3>
            <form class="mb-3 mt-3" action="{{ Request::url() }}" method="POST">
            @csrf

                <div class="mt-2 card">
                    <div class="card-header">予約内容</div>
                    <div class="card-body">
                        <p>{{ $experience->name }}</p>
                        <p>日程: {{ $experience->start_date }}</p>
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
