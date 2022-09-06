<style>
*{
    box-sizing:content-box;
}
.card-text {
    word-wrap: break-word;
}
.cell{
    max-width:200px;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<li class="item mx-2">
    <div class="card shadow mb-3 cell" style="border-radius: 18px;" >
        <div class="cell" style="display: flex; ">
            <a href="/experience/{{ $experienceFolder->id }}" style="text-decoration: none; color: inherit;">
                <div class="cell" style="display: flex; flex: 1 1 auto; height: 100%; flex-direction:column;">
                    <div class="img-square-wrapper">
                        <img style="object-fit: cover; height: 160px;border-top-left-radius: 18px;border-top-right-radius: 18px;" class="cell" src="{{ $experienceFolder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap" width="200">
                    </div>
                    <div class="card-header border-none" style="background:white;border-bottom:none">
                        <h5 class="card-title text-center mb-0 text-truncate" >{{ $experienceFolder->name }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0 card-text text-end">　大人：<span class="small fw-normal" style="font-size:10px;">税込</span>{{ number_format($experienceFolder->price_adult) }}<span class="small fw-normal" style="font-size:10px;">円～</span></p>
                        <p class="card-text text-end">子ども：<span class="small fw-normal" style="font-size:10px;">税込</span>{{ number_format($experienceFolder->price_child) }}<span class="small fw-normal" style="font-size:10px;">円～</span></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</li>



