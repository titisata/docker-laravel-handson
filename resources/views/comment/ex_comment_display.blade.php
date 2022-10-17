@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
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
}
ul{
    list-style-type: none
}
a{
    text-decoration:none;
    color:inherit;
}
.f-pink{
    background-color:#BB4156;

}
.f-pink{
    color:#BB4156;

}
.btn-shadow{
    box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 65%);
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

.pink{
    color:#BB4156;
}
</style>

<div class="card" style="height: 400px;">
    <img class="card-img" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="">
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
        
            <div class="d-flex align-items-center" >
                <h3 class="fw-bold py-auto text-gray" style="--bs-bg-opacity: .10;" ><a class="link" href="/experience/{{ $experienceFolder->id }}">{{ $experienceFolder->name }}</a>のクチコミ</h3>
            </div>
       

            <div class="mt-5 card">

                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between">
                        <h4 class="m-3 fw-bold">クチコミ</h4>
                    </div>

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


                    @if( $user->id != $mycomment->user_id )
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
                        <p>投稿できません</p>
                    </div>

                    @endif
                </div>

                <div class="card-body">
                    @foreach ($all_comments as $comment)
                        <div class="mt-2">
                            @include('components.comment_cell', ['comment'=>$comment])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    </div>
</div>



@endsection
