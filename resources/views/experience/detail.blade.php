@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
<script>
    const events_data = @json($events);
    const holiday_events_date = @json($holiday_events);
    const work_events_date = @json($work_events);
    const experienceFolder = @json($experienceFolder);

    const events = Object.entries(events_data).map(([key, value]) =>  {
        return {
            title: `${value.name}: ${value.count}件`,
            start: value.start,
            color: value.count < value.quantity ? '#5DC075' : '#F56E6E'
        };
    });

    const holiday_events = Object.entries(holiday_events_date).map(([key, value]) =>  {
        return {
            title: `${value.title}`,
            start: value.date,
            color: '#F56E6E'
        };
    });
    // const work_events = Object.entries(work_events_date).map(([key, value]) =>  {
    //     return {
    //         title: `${value.title}: ${value.quantity}件`,
    //         start: value.date,
    //         color: value.count < value.quantity ? '#5DC075' : '#F56E6E'
    //     };
    // });

    console.log(events);
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl,  {
            locale: 'ja',
            buttonText: {
                prev:     '<',
                next:     '>',
                prevYear: '<<',
                nextYear: '>>',
                today:    '今日',
                month:    '月',
                week:     '週',
                day:      '日',
                list:     '一覧'
            },
            events: [...events, ...holiday_events],
            dateClick: function(info) {
                if (Object.entries(holiday_events_date).some(([key, value]) => value.date == info.dateStr)) {
                    alert('お休みです');
                    return;
                }
                window.location.href = experienceFolder.id + '?keyword=' + info.dateStr;
            }
        });
        calendar.render();
    });
</script>

<style>
.card-img-overlay{
    padding: 0;
    top: calc(90% - 0.5rem);
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
}
.f-pink{
    background-color:#BB4156;

}
.btn-shadow{
    box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 65%);
}
.bg-f-part{
    background-color:#343a40;
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
        <div class="col-md-9">
            <div class="card" style="height: 300px;">
                <img class="card-img" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
                <div class="card-img-overlay">
                    <h4 class="bg-secondary text-white" style="--bs-bg-opacity: .5;" >{{ $experienceFolder->name }}</h4>
                </div>
            </div>



            <div class="d-flex flex-wrap justify-content-evenly">
                <img class="card-img w-25 m-2" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
                <img class="card-img w-25 m-2" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
                <img class="card-img w-25 m-2" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
                <img class="card-img w-25 m-2" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
                <img class="card-img w-25 m-2" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
                <img class="card-img w-25 m-2" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]->image_path }}" alt="">
            </div>



            <div class="card mt-4">
                <!-- <div class="card-header">詳細</div> -->
                <div class="card-body">
                    <!-- <p>名前: {{ $experienceFolder->name }}</p>
                    <p>値段: {{ $experienceFolder->price }}円</p> -->
                    <p class="fw-bold h4">{{ $experienceFolder->description }}</p>
                    <p>
                        この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                        この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                        この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                        この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                    </p>
                    <p></p>
                    <p class="fw-bold text-end h3 border-top pt-3">{{ $experienceFolder->price }}円~</p>
                    <!-- <p>開催日: {{ app('request')->input('keyword') }}</p>
                    <p>{{ $experienceFolder->is_lodging ? ('宿泊日: ' . app('request')->input('keyword'). ($experienceFolder->is_before_lodging ? ' (前泊)' : ' (後泊)') ) : '宿泊なし' }}</p> -->
                </div>
            </div>

            <!-- <div class="mt-2 card"> -->
                <!-- <div class="card-header">予約</div> -->
                <!-- <div class="card-body">
                    @forelse($experiences as $experience)
                        <div class="mt-1 p-3 card">
                            <div>
                                <p>{{ $experience->name }}</p>
                                <p>大人: {{ $experience->price_adult }}円 子ども: {{ $experience->price_child }}円</p>
                            </div>
                        </div>
                    @empty
                        <p>この体験はご利用できません</p>
                    @endforelse
                </div> -->

                @if (app('request')->input('keyword') == "")
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                @else
                    <div class="card-body">
                        @forelse($experiences as $experience)
                            <a class="btn btn-lg btn-pink py-4 rounded-pill text-white my-2 w-100 btn-shadow fs-2" href="{{ $experienceFolder->id }}/{{ $experience->id }}?{{ explode('?', str_replace(url('/'),"",request()->fullUrl()))[1] }}">{{ $experience->name }}</a>
                        @empty
                            <p>この体験はご利用できません</p>
                        @endforelse
                    </div>
                @endif
            <!-- </div> -->

            <div class="mt-2 card">
                <div class="card-header h4">
                    クチコミ
                </div>

                <div class="d-flex flex-column">
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
