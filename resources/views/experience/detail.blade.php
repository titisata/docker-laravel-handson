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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="height: 200px;">
                <img class="card-img" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
                <div class="card-img-overlay">
                    <h3 class="bg-secondary text-white" style="--bs-bg-opacity: .5;" >{{ $experienceFolder->name }}</h3>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">詳細</div>
                <div class="card-body">
                    <p>名前: {{ $experienceFolder->name }}</p>
                    <p>値段: {{ $experienceFolder->price }}円</p>
                    <p>説明: {{ $experienceFolder->description }}</p>
                    <p>開催日: {{ app('request')->input('keyword') }}</p>
                    <p>{{ $experienceFolder->is_lodging ? ('宿泊日: ' . app('request')->input('keyword'). ($experienceFolder->is_before_lodging ? ' (前泊)' : ' (後泊)') ) : '宿泊なし' }}</p>
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
