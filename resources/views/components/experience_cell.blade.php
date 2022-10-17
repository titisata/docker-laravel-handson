<?php
$limit = '20'.now()->addDay($experienceFolder->close_date)->format('y-m-d');

?>
@if($limit < app('request')->input('keyword') )
<div class="mb-3 col-lg-6 mt-4 rounded-4 p-3">
    <div class="card contain" style="border-radius: 18px;">
        <a href="/experience/{{ $experienceFolder->id }}?{{ explode('?', str_replace(url('/'),"",request()->fullUrl()))[1] }}" style="text-decoration: none; color: inherit; ">
            <div class="" style="height: 100%;">
                <div class="card-body p-0">
                    <img style="object-fit: cover; width:100%; height:320px;  border-top-left-radius: 18px;border-top-right-radius: 18px;" class=" image" src="{{ $experienceFolder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap">    
                    <h4 class="card-title text-start fw-bold ms-3 mt-3 text-truncate font-gray" >{{ $experienceFolder->name }}</h4> 
                    <p class="card-text text-wrap mt-3 text-truncate m-3 font-gray text-overflow-lines">{{ $experienceFolder->description }}</p>
                    <p class="card-text fw-bold fs-3 text-nowrap mt-3 text-end me-2 font-more-gray mb-0"><span class="small fw-normal" style="font-size:12px;">税込</span>{{ $experienceFolder->price_child }}<span class="small fw-normal me-3 " style="font-size:12px;">円/人~</span></p>
                    <p class="card-text font-gray text-end me-4 mb-3">{{ $experienceFolder->is_lodging ? ('宿泊日: ' . ($experienceFolder->is_before_lodging ?  (new DateTime(app('request')->input('keyword')))->modify("-1day")->format('Y-m-d') . ' (前泊)' : app('request')->input('keyword') . ' (後泊)') ) : '宿泊なし' }}</p>
                    <p>{{'20'.now()->addDay($experienceFolder->close_date)->format('y-m-d')}}</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endif

