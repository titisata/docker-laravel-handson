@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
<script>
    const events_data = @json($events);
    const holiday_events_date = @json($holiday_events);
    const work_events_date = @json($work_events);
    const experienceFolder = @json($experienceFolder);

    const event_start_date = '{{$event_start_date}}';
    const event_end_date = '{{$event_end_date}}';
    const event_close_date = '{{$event_close_date}}';
    const now = '{{$now}}';

    const events = Object.entries(events_data).map(([key, value]) =>  {
        return {
            // title: `${value.name}: ${value.count}件`,
            start: value.start,
            color: '#00000000',
            // image_url: value.count < value.quantity ? '/images/maru.png' : '/images/batu.png',
        };
    });

    const holiday_events = Object.entries(holiday_events_date).map(([key, value]) =>  {
        return {
            title: `${value.title}`,
            start: value.date,
            color: '#F56E6E',
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
    console.log(event_start_date + '--' + event_end_date);
    console.log('c'+event_close_date);
    console.log(now);
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
            dayCellContent: function (e) {
            e.dayNumberText = e.dayNumberText.replace('日', '');
            },
            events: [...events, ...holiday_events],
            height:'auto',
            dateClick: function(info) {
                var newDate = new Date(info.dateStr + " 20:00:00");
                if( event_close_date == now){
                    if (newDate < Date.now()) {
                        return;
                    }
                }else{
                    var newDate_2 = new Date(info.dateStr + " 00:00:00");
                    var newCloseDate = new Date(event_close_date);
                    if (newDate_2 < newCloseDate) {
                        return;
                    }
                }
                var newEndDate = new Date(event_end_date);
                if (newDate > newEndDate) {
                    alert('期間を過ぎています');
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
                    titleEvent.innerHTML = arg.event._def.title;
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

            loading: function(bool) {
                if(bool) {
                    // document.getElementById('loading').style.display = 'block';
                } else {
                    // document.getElementById('loading').style.display = 'none';

                    setTimeout(() => {
                        day_over();
                        day_close();
                    }, 10);  
                }
            },
        });
            calendar.render();

            let targets = document.getElementsByClassName("fc-button");
            for(let i = 0; i < targets.length; i++){
                targets[i].addEventListener("click",() => {
                    day_over();
                    day_close();
                }, false);
            }
        }

    });

    function day_over(){
        let els = document.getElementsByClassName('fc-day-future');
        let day1 = new Date(event_end_date)
        for (let i = 0; i <  els.length; i++) {
            let day2 = new Date(els[i].dataset.date + " 00:00:00");
            if(day1.getTime() < day2.getTime()){
                els[i].classList.add("fc-day-over");
            }
        }
    }

    function day_close(){    
        let c_els = document.getElementsByClassName('fc-day-future');
        if( event_close_date != now){
            let c_day1 = new Date(event_close_date)
            for (let i = 0; i <  c_els.length; i++) {
                if (i == 1){
                    let today_els = document.getElementsByClassName('fc-day-today');   
                    for (let i = 0; i <  today_els.length; i++) {
                        today_els[i].classList.add("fc-day-over");
                    } 
                    
                }
                let c_day2 = new Date(c_els[i].dataset.date + " 00:00:00");
                if(c_day1.getTime() > c_day2.getTime()){
                    c_els[i].classList.add("fc-day-over");
                }
            }
        }

        
    }

    var count = 0;

    function submit_favorite(){
        document.favorite_form.submit();
        
        var h = document.getElementById('favorite');

        if(count % 2 === 0 ){
            h.className += ' text-secondary';
        }else{  
            h.classList.remove('text-secondary');
        }
        count++;
        


        return false
    }

    function submit_not_favorite(){
        document.favorite_form.submit();
        
        var n = document.getElementById('not_favorite');
       
        if(count % 2 === 0 ){
            n.className += ' pink';
        }else{
            
            n.classList.remove('pink');
        }
        count++;

        return false
    }
</script>

<style>
/* カレンダースタイル */

.fc-day-past {
    /* background-color: #D7D7D74D; */
    background: var(--fc-non-business-color,rgba(238, 240, 241));
    opacity: .2;
}

.fc-day-over {
    /* background-color: #D7D7D74D; */
    background: var(--fc-non-business-color,rgba(238, 240, 241));
    opacity: .2;
}

.fc-day-future{
    background-color: rgba(238, 240, 241);
}

.fc-scroller-harness{
    background: var(--fc-non-business-color,rgba(238, 240, 241));
}

.fc-dayGridMonth-button  {
  display: none!important;
}

.fc-timeGridWeek-button {
  display: none!important;
}

.fc-timeGridDay-button {
  display: none!important;
}

  .fc-listMonth-button {
  display: none!important;
}

  .fc .fc-col-header-cell-cushion {
  display: inline-block;
  padding: 2px 4px;
}

.fc .fc-col-header-cell-cushion { /* needs to be same precedence */
  padding-top: 5px; /* an override! */
  padding-bottom: 5px; /* an override! */
}

.fc .fc-daygrid-day-top {
  justify-content: center;
}

.fc-daygrid-day-number{
  font-weight: bold;
  font-size:24px ;
}

.fc-theme-standard td, .fc-theme-standard th {
  border: none; 
  /* border: 1pxsolidvar(--fc-border-color,#ddd); */
}

.fc-theme-standard .fc-scrollgrid {
  border: none; 
  /* border: 1pxsolidvar(--fc-border-color,#ddd); */
}

.fc table {
    font-size: 1.2em;
}

.fc-toolbar-title{
    font-weight:bold;
}

.fc-col-header{
  border-bottom: 1px solid;
}

#calendar {
    background-color: #D7D7D74D;
}


.fc .fc-daygrid-day-frame {
  position: relative;
  min-height: 85%;
  margin:4px 8px;
  box-shadow: 4px 4px 4px #D7D7D74D;
  border-radius:5px;
  background-color: white;
}

@media screen and (max-width: 900px) {
    .fc .fc-daygrid-day-frame {
    margin:1px 2px;
    box-shadow: 2px 2px 2px #D7D7D74D;
    }
}

.fc .fc-non-business {
    /* background-color: white; */
    background: var(--fc-non-business-color,rgba(255, 255, 255, 0.1));
}

.fc-scrollgrid-sync-inner{
  margin-bottom:5px;
}

.fc-day-sun{
  color:red;
}

.fc-day-sat{
  color:blue;
}

.fc .fc-daygrid-body-natural .fc-daygrid-day-events {
    margin-bottom: 0;
}

.fc .fc-scroller {

    padding-top: 10px;
}

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

<input type="hidden" id="favorite_id" value="{{ $experienceFolder->id }}">
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
                    
                    @if( $user!=null )

                        <div class="d-flex align-items-center" >
                            <h3 class="fw-bold py-auto text-gray" style="--bs-bg-opacity: .10;" >{{ $experienceFolder->name }}</h3>
                            <div class="ms-3" >
                                @if(!empty($favorite))
                                    <i id="favorite" class="bi bi-heart-fill pink fs-3" onclick="submit_favorite();"></i>
                                @else
                                    <i id="not_favorite" class="bi bi-heart-fill text-gray fs-3" onclick="submit_not_favorite();"></i>
                                @endif
                            </div>
                        </div>

                        <form name="favorite_form" action="/favorite_edit" method="POST" target="sendFavorite">
                            @csrf
                            <input type="hidden" name="f_user_id" value="{{ $user->id }}">
                            <input type="hidden" name="f_experienceFolder_id" value="{{ $experienceFolder->id }}">
                            <input type="hidden" name="f_table_name" value="experience_folders">
                        </form>

                        <iframe name="sendFavorite" style="width:0px;height:0px;border:0px;"></iframe>
                    @else
                        <div class="d-flex align-items-center" >
                            <h3 class="fw-bold py-auto text-gray" style="--bs-bg-opacity: .10;" >{{ $experienceFolder->name }}</h3>
                        </div>
                    @endif

                    
                    
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
                    <p class="mb-4 text-start"><a role="button" href="/partner/{{ $experienceFolder->user_id }}" class="btn btn-outline-secondary rounded-pill">会社情報</a></p>
                    

                    <h4 class="fw-bold pt-4  text-gray">集合場所</h4>
                    <p class=" text-gray fs-5">{{ $experienceFolder->address }}</p>

                    <h4 class="fw-bold pt-4  text-gray">期間</h4>
                    <p class=" text-gray fs-5">{{ $experienceFolder->start_date->format('Y/m/d') }} ～ {{ $experienceFolder->end_date->format('Y/m/d') }}</p>

                    @if (app('request')->input('keyword') == "")
                        <div class="">
                            <div class='calendar'></div>
                            <p class="text-danger fs-4">※予約する日を選択してください</p>
                        </div>
                    @else
                        <div class="card-body px-0 pt-3 border-top">
                            <div class="bg-f-part p-2 rounded-2 mb-2 d-lg-flex align-items-center justify-content-center">
                                <h5 class="text-white mb-lg-0">体験日: {{ app('request')->input('keyword') }}</h5>
                                <h5 class="text-white mb-0 ms-lg-4">
                                    {{ $experienceFolder->is_lodging ? ('宿泊日: ' . ($experienceFolder->is_before_lodging ? ' (前泊)'.(new DateTime(app('request')->input('keyword') ) )->modify("-1day")->format('Y-m-d') : ' (後泊) ' . app('request')->input('keyword') ) ) : '宿泊なし' }}
                                </h5>
                            </div>
                            @if( '20'.$limit_date < app('request')->input('keyword') || '20'.$limit_date == '20'.$date )
                            <div>
                                <a  class="link fs-5" href="{{url()->current()}}" >
                                    別の日を選択する
                                </a>
                            </div>
                            @else
                            
                            @endif
                            <div class="py-2 ms-lg-auto d-lg-flex mt-3">
                                
                                <p class="fw-bold text-start fs-4">大人 : <span class="small small_font ">税込</span><span class="fw-bold">{{ number_format($experienceFolder->price_adult) }}</span><span class="small small_font">円 / 人~</span></p>
                                
                                <p class="fw-bold text-start fs-4 ms-lg-4">子ども : <span class="small small_font">税込</span><span class="fw-bold">{{ number_format($experienceFolder->price_child) }}</span><span class="small small_font">円 / 人~</span></p>
                            </div>
                            @if( '20'.$limit_date < app('request')->input('keyword')  || '20'.$limit_date == '20'.$date )
                                @forelse($experiences as $experience)
                                    @if (in_array($experience->id, $full_experience))
               
                                    @else
                                        <a class="btn btn-lg btn-pink rounded-pill text-white my-2 py-3 w-100 btn-shadow fs-5" href="{{ $experienceFolder->id }}/{{ $experience->id }}?{{ explode('?', str_replace(url('/'),"",request()->fullUrl()))[1] }}">{{ $experience->name }}</a>
                                    @endif
                                @empty
                                    <p class="text-danger">この体験はご利用できません</p>
                                @endforelse
                            @else
                                <div class="my-3">
                                    <p class="text-danger fs-5">※予約ができない日付が選択されています。別の日を選択してください。</p>
                                    <a  class="link fs-5" href="{{url()->current()}}" >
                                    別の日を選択する
                                    </a>
                                    
                                </div>  
                            @endif
                        </div>
                    @endif
                    
                    

                    <div class="d-flex justify-content-between align-items-start pt-3 flex-wrap">
                        @if (app('request')->input('keyword') != "")
                            <div class="bg-f-part p-2 rounded-2 d-lg-none">
                                <p class="text-white fs-5">体験日: {{ app('request')->input('keyword') }}</p>
                                <p class="text-white mb-0 fs-5">{{ $experienceFolder->is_lodging }}</p>
                            </div>
                            

                        @endif
                            

                    </div>

                    <div class="mt-5 card">

                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-between">
                                <h4 class="m-3 fw-bold">クチコミ</h4>
                                <a class="m-3 link" href="/comment/ex_comment_display/{{ $experienceFolder->id }}">全てのクチコミを見る</a>
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
