<style>
*{
    box-sizing:content-box;
}
.card-text {
    word-wrap: break-word;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">


<div class="card mb-3 width: 100%;">
    <div style="display: flex; flex: 1 1 auto; height: 200px; width: 100%;">
    <a href="/experience/{{ $experienceFolder->id }}?{{ explode('?', str_replace(url('/'),"",request()->fullUrl()))[1] }}" style="text-decoration: none; color: inherit;">
            <div style="display: flex; flex: 1 1 auto; height: 100%;">
            <div class="img-square-wrapper">
                    <img style="object-fit: cover;height: 180px;" class="rounded-top" src="{{ $experienceFolder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap" width="270">
                </div>
                <div class="card-header border-none" style="background:white;border-bottom:none">
                    <h5 class="card-title text-center mb-0 text-truncate" >{{ $experienceFolder->name }}</h5>
                </div>
                <div class="card-body">     
                    <p class="card-text text-end fw-bold fs-4">￥{{ $experienceFolder->price_child }}～</p>
                    <p class="card-text">{{ $experienceFolder->is_lodging ? ('宿泊日: ' . ($experienceFolder->is_before_lodging ?  (new DateTime(app('request')->input('keyword')))->modify("-1day")->format('Y-m-d') . ' (前泊)' : app('request')->input('keyword') . ' (後泊)') ) : '宿泊なし' }}</p>
                </div>
            </div>
        </a>
    </div>
</div>

