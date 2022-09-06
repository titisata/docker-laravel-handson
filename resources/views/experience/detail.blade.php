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
            // title: `${value.name}: ${value.count}件`,
            start: value.start,
            color: '#00000000',
            image_url: value.count < value.quantity ? '/images/maru.png' : '/images/batu.png',
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
        var calendarEls = document.getElementsByClassName('calendar');
        for (const calendarEl of calendarEls) {
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
            height:'auto',
            dateClick: function(info) {
                var newDate = new Date(info.dateStr);
                if (newDate < Date.now()) {
                    return;
                }

                if (Object.entries(holiday_events_date).some(([key, value]) => value.date == info.dateStr)) {
                    alert('お休みです');
                    return;
                }
                window.location.href = experienceFolder.id + '?keyword=' + info.dateStr;
            },
            eventContent: function(arg) {
                let arrayOfDomNodes = []
                // title event
                let titleEvent = document.createElement('div')
                if(arg.event._def.title) {
                    titleEvent.innerHTML = arg.event._def.title
                    titleEvent.classList = "fc-event-title fc-sticky"
                }

                // image event
                let imgEventWrap = document.createElement('div')
                imgEventWrap.style.cssText = 'text-align: center';
                if(arg.event.extendedProps.image_url) {
                    let imgEvent = '<img src="' + arg.event.extendedProps.image_url + '" height="20px" >'
                    imgEventWrap.classList = "fc-event-img"
                    imgEventWrap.innerHTML = imgEvent;
                }

                arrayOfDomNodes = [ titleEvent,imgEventWrap ]

                return { domNodes: arrayOfDomNodes }
            },
        });
        calendar.render();

        }

    });
</script>

<style>
ul.horizontal-list {
    overflow-x: auto;
    white-space: nowrap;
}
li.item {
	display: inline-block;
}
.fc-day-past {
    background-color: #969696;
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
<div class="card" style="height: 400px;">
    <img class="card-img" style="height: 100%; object-fit: cover;" src="{{ $experienceFolder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="">
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-11">
            
            <div class="d-flex flex-wrap justify-content-between">
                <ul class="horizontal-list ps-0" >
                    @foreach($experienceFolder->images() as $image)
                        <li class="item mx-2">
                            <a role="button" data-bs-toggle="modal" data-bs-target="#modal{{ $image->id }}" class="mt-5" style="width:30%;">
                                <img class="card-img" style="width:140px; height: 140px; object-fit: cover;" src="{{ $image->image_path }}" alt="">
                            </a>
                            <div class="modal fade" id="modal{{ $image->id }}" tabindex="-1" aria-labelledby="ModalLabel">
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
                        </li>    
                    @endforeach
                </ul>    
            </div>

            <div class="row">
                <div class="my-4 col-12 col-lg-7">
                    
                    <h3 class="fw-bold py-auto text-gray" style="--bs-bg-opacity: .10;" >{{ $experienceFolder->name }}</h3>
                    @if($experienceFolder->average_rate < 1.5)
                            <p class="mb-0">テスト用に表示、0は表示しないようにする</p>
                            <div class="d-flex mb-3">
                                <img src="/images/star1.png" style="width:120px;height35px">
                            </div>
                        @elseif($experienceFolder->average_rate < 2)
                            <div class="d-flex mb-3">
                            <img src="/images/star1.5.png" style="width:120px;height35px">
                            </div>
                        @elseif($experienceFolder->average_rate < 2.5)
                            <div class="d-flex mb-3">
                            <img src="/images/star2.png" style="width:120px;height35px">
                            </div>
                        @elseif($experienceFolder->average_rate < 3)
                            <div class="d-flex mb-3">
                            <img src="/images/star2.5.png" style="width:120px;height35px">
                            </div>
                        @elseif($experienceFolder->average_rate < 3.5)
                            <div class="d-flex mb-3">
                            
                            <img src="/images/star3.png" style="width:120px;height35px">
                            </div>
                        @elseif($experienceFolder->average_rate < 4)
                            <div class="d-flex mb-3">
                            
                            <img src="/images/star3.5.png" style="width:120px;height35px">
                            </div>
                        @elseif($experienceFolder->average_rate < 4.5)
                            <div class="d-flex mb-3">
                            
                            <img src="/images/star4.png" style="width:120px;height35px">
                            </div>
                        @elseif($experienceFolder->average_rate < 5)
                            <div class="d-flex mb-3">
                            
                            <img src="/images/star4.5.png" style="width:120px;height35px">
                            </div>
                        @elseif($experienceFolder->average_rate = 5)
                            <div class="d-flex mb-3">
                            
                            <img src="/images/star5.png" style="width:120px;height35px">
                            </div>
                        @endif
                    <p class="text-gray fs-5">{{ $experienceFolder->description }}</p>
                    <p class="mb-4 text-start"><a role="button" href="/partner/{{ $experienceFolder->partner->id }}" class="btn btn-outline-secondary rounded-pill">会社情報</a></p>

                    <h4 class="fw-bold pt-4  text-gray">集合場所</h4>
                    <p class=" text-gray fs-5">{{ $experienceFolder->address }}</p>

                    @if (app('request')->input('keyword') == "")
                        <div class="">
                            <div class='calendar'></div>
                        </div>
                    @else
                        <div class="card-body px-0 pt-3 border-top">
                            <div class="bg-f-part p-2 rounded-2 mb-2 d-lg-flex align-items-center justify-content-center">
                                <h5 class="text-white mb-lg-0">体験日: {{ app('request')->input('keyword') }}</h5>
                                <h5 class="text-white mb-0 ms-lg-4">{{ $experienceFolder->is_lodging ? ('宿泊日: ' . ($experienceFolder->is_before_lodging ?  (new DateTime(' (前泊)'.app('request')->input('keyword')))->modify("-1day")->format('Y-m-d') : ' (後泊) ' . app('request')->input('keyword') ) ) : '宿泊なし' }}</h5>
                            </div>
                            <div>
                                <a  class="text-primary" href="{{url()->current()}}" >
                                    別の日を選択する
                                </a>
                            </div>
                            <div class="py-2 ms-lg-auto d-lg-flex mt-3">
                                
                                <p class="fw-bold text-start fs-4">大人 : <span class="small small_font ">税込</span><span class="fw-bold">{{ number_format($experienceFolder->price_adult) }}</span><span class="small small_font">円 / 人</span></p>
                                
                                <p class="fw-bold text-start fs-4 ms-lg-4">子ども : <span class="small small_font">税込</span><span class="fw-bold">{{ number_format($experienceFolder->price_child) }}</span><span class="small small_font">円 / 人</span></p>
                            </div>
                            @forelse($experiences as $experience)
                                <a class="btn btn-lg btn-pink rounded-pill text-white my-2 py-3 w-100 btn-shadow fs-5" href="{{ $experienceFolder->id }}/{{ $experience->id }}?{{ explode('?', str_replace(url('/'),"",request()->fullUrl()))[1] }}">{{ $experience->name }}</a>
                            @empty
                                <p>この体験はご利用できません</p>
                            @endforelse
                        </div>
                    @endif
                    
                    

                    <div class="d-flex justify-content-between align-items-start border-top pt-3 flex-wrap">
                        @if (app('request')->input('keyword') != "")
                            <div class="bg-f-part p-2 rounded-2 d-lg-none">
                                <p class="text-white fs-5">体験日: {{ app('request')->input('keyword') }}</p>
                                <p class="text-white mb-0 fs-5">{{ $experienceFolder->is_lodging ? ('宿泊日: ' . ($experienceFolder->is_before_lodging ?  (new DateTime(app('request')->input('keyword')))->modify("-1day")->format('Y-m-d') :  app('request')->input('keyword') ) ) : '宿泊なし' }}</p>
                            </div>
                            

                        @endif
                            

                    </div>

                    <div class="mt-3 col-12 col-lg-6 d-lg-none">
                        @if (app('request')->input('keyword') == "")
                            <div class="card-body p-0">
                                <div class='calendar'></div>
                            </div>

                        @endif
                        @if (app('request')->input('keyword') != "")
                        <div>
                            <div class="card-body mt-2 p-0 col-12 col-lg-6 d-lg-none">
                                @forelse($experiences as $experience)
                                    <a class="btn btn-lg btn-pink rounded-pill text-white my-2 w-100 btn-shadow fs-3" href="{{ $experienceFolder->id }}/{{ $experience->id }}?{{ explode('?', str_replace(url('/'),"",request()->fullUrl()))[1] }}">{{ $experience->name }}</a>
                                @empty
                                    <p>この体験はご利用できません</p>
                                @endforelse
                            </div>

                        </div>

                        @endif

                    </div>





                    <div class="mt-5 card">

                        <div class="d-flex flex-column">
                            <h4 class="m-3 fw-bold">クチコミ</h4>

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
                <div class="mt-4 col-12 d-none d-lg-block col-lg-5">
                    <iframe
                        width="100%"
                        height="300"
                        frameborder="0" style="border:0"
                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCbEnku7Kl5mCIvWZgKOpgN-2wjmehRvyU&q={{ $experienceFolder->address }}"
                        allowfullscreen>
                    </iframe>
                    
                </div>

            </div>




        </div>
    </div>
</div>



@endsection
