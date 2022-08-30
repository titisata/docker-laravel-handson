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
                        <img style="object-fit: cover; height: 160px;border-top-left-radius: 18px;border-top-right-radius: 18px;" class="cell" src="/{{ $experienceFolder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap" width="200">
                    </div>
                    <div class="card-header border-none" style="background:white;border-bottom:none">
                        <h6 class="card-title text-center mb-0 text-truncate" >{{ $experienceFolder->name }}</h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-0 card-text text-end fw-bold fs-5">　大人：{{ $experienceFolder->price_adult }}円～</p>
                        <p class="card-text text-end fw-bold fs-5">子ども：{{ $experienceFolder->price_child }}円～</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</li>



