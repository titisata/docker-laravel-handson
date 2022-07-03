@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-3">{{ $experienceFolder->name }}の予約</h3>

            <div class="mt-2 card">
                <div class="card-header">予約内容</div>
                <div class="card-body">
                    <p>{{ $experience->name }}</p>
                    <p>{{ $experience->start_date }}</p>
                    <p>大人: {{ $experience->price_adult }}円 子ども: {{ $experience->price_child }}円</p>
                    <form class="mb-3 mt-3" action="{{ Request::url() }}" method="POST">
                        @csrf
                        <label for="keyword">大人人数</label><input name="keyword" type="number">
                        <label for="keyword">子ども人数</label><input name="keyword" type="number">
                        <input type="submit" value="カートに入れる">
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
