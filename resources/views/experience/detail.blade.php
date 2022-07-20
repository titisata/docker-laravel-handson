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
                <img class="card-img" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="">
                <div class="card-img-overlay d-flex align-items-center justify-content-center" style="background: linear-gradient(rgba(0,0,0,0),rgba(251, 110, 134));height:68px;">
                    <h3 class="fw-bold text-white py-auto" style="--bs-bg-opacity: .10;" >{{ $experienceFolder->name }}</h3>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-between">
                @foreach($experienceFolder->images() as $image)
                    <a role="button" data-bs-toggle="modal" data-bs-target="#Modal" class="mt-5" style="width:30%;">
                        <img class="card-img" style=" height: 140px; object-fit: cover;" src="{{ $image->image_path }}" alt="">
                    </a>
                    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-body">
                                    <img class="card-img" style="width:100%; object-fit: cover;" src="{{ $image->image_path }}" alt="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">閉じる</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="my-5 col-12 col-lg-6">  
                    <p class="mb-4">{{ $experienceFolder->description }}</p>
            
                    <p class="fw-bold text-end h3 border-top pt-4">{{ $experienceFolder->price }}円~</p>  
                    
                    <!-- <div class="mt-4 col-12 col-lg-6 d-lg-none">
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
                    </div> -->
                    
                    <div class="mt-5 card">

                        <div class="d-flex flex-column">
                            <h4 class="m-3 fw-bold">クチコミ</h4>
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
                <div class="mt-4 col-12 col-lg-6">
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
                </div>

            </div>
            

           

        </div>
    </div>
</div>



@endsection
