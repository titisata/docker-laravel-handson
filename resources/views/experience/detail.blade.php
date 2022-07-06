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

<script>
async function commentCreate(ex_id) {
    const content = document.getElementById('comment');
    const rate = document.getElementById('rate_input');
    const obj = {
        experienceFolderId: ex_id,
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
    fetch("/api/comment/experience", {method, headers, body})
        .then(_ => location.reload());
}
</script>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="height: 300px;">
                <img class="card-img" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
                <div class="card-img-overlay">
                    <h3 class="bg-secondary text-white" style="--bs-bg-opacity: .5;" >{{ $experienceFolder->name }}</h3>
                </div>
                <div class="d-flex flex-wrap justify-content-evenly">
                    <img class="card-img col-3 m-2" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
                    <img class="card-img col-3 m-2" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
                    <img class="card-img col-3 m-2" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
                    <img class="card-img col-3 m-2" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
                    <img class="card-img col-3 m-2" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
                    <img class="card-img col-3 m-2" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
                </div>
            </div>


        
           
                


            <div class="card mt-3">
                <!-- <div class="card-header">詳細</div> -->
                <div class="card-body">
                    <!-- <p>名前: {{ $experienceFolder->name }}</p>
                    <p>値段: {{ $experienceFolder->price }}円</p> -->
                    <p class="fw-bold">{{ $experienceFolder->description }}</p>
                    <p>
                        この文章はダミーです。文字の大きさ、量、字間、行間等を確認す
                        るために入れています。この文章はダミーです。文字の大きさ、
                        量、字間、行間等を確認するために入れています。
                        この文章はダミーです。文字の大きさ、量、字間、行間等を確認す
                        るために入れています。この文章はダミーです。文字の大きさ、
                        量、字間、行間等を確認するために入れています。
                    </p>
                    <!-- <p>開催日: {{ app('request')->input('keyword') }}</p>
                    <p>{{ $experienceFolder->is_lodging ? ('宿泊日: ' . app('request')->input('keyword'). ($experienceFolder->is_before_lodging ? ' (前泊)' : ' (後泊)') ) : '宿泊なし' }}</p> -->
                </div>
            </div>

            <div class="mt-2 card">
                <!-- <div class="card-header">予約</div> -->
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

            <div class="mt-2 card">
                <div class="card-header">口コミ</div>

                <div class="d-flex flex-column">
                    <div class="m-2">
                        <textarea class="form-control" row="10" cols="60" placeholder="コメント" id="comment" style="font-size:0.24rem;"></textarea>
                        <div class="d-flex  justify-content-between">
                            <select id="rate_input" style="height:20px;width:50px">
                                <option value="1">☆1</option>
                                <option value="2">☆2</option>
                                <option value="3">☆3</option>
                                <option value="4">☆4</option>
                                <option value="5" selected="selected">☆5</option>
                            </select>
                            <button class="btn btn-outline-primary btn-sm" style="font-size:0.32rem; " onclick="commentCreate({{ $experienceFolder->id }})">投稿</button>
                        </div>
                    </div>
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
