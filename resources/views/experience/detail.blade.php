@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-3">{{ $experienceFolder->name }}</h3>

            <div class="card">
                <div class="card-header">詳細</div>
                <div class="card-body">
                    <p>名前: {{ $experienceFolder->name }}</p>
                    <p>値段: {{ $experienceFolder->price }}円</p>
                    <p>説明: {{ $experienceFolder->description }}</p>
                    <p>宿泊日: {{ app('request')->input('keyword') }}</p>
                    <p>{{ $experienceFolder->is_lodging ? ('宿泊あり ' . ($experienceFolder->is_before_lodging ? '前泊' : '後泊') ) : '宿泊なし' }}</p>
                    <p></p>
                </div>
            </div>

            <div class="mt-2 card">
                <div class="card-header">予約</div>
                <div class="card-body">
                    @forelse($experiences as $experience)
                        <div class="mt-1 p-3 card">
                            <div>
                                <p>{{ $experience->name }}</p>
                                <p>大人: {{ $experience->price_adult }}円 子ども: {{ $experience->price_child }}円</p>
                                <a class="btn btn-primary" href="{{ $experienceFolder->id }}/{{ $experience->id }}?{{ explode('?', str_replace(url('/'),"",request()->fullUrl()))[1] }}">予約する</a>
                            </div>
                        </div>
                    @empty
                        <p>この体験はご利用できません</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
