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
            <a href="/goods/{{ $goods_folder->id }}" style="text-decoration: none; color: inherit;">
                <div class="cell" style="display: flex; flex: 1 1 auto; height: 100%; flex-direction:column;">
                    <div class="img-square-wrapper">
                        <img style="object-fit: cover; height: 160px;border-top-left-radius: 18px;border-top-right-radius: 18px;" class="cell" src="{{ $goods_folder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap" width="200">
                    </div>
                    <div class="card-header border-none" style="background:white;border-bottom:none">
                        <h5 class="card-title text-center mb-0 text-truncate" >{{ $goods_folder->name }}</h5>
                    </div>
                    <div class="card-body" >
                        <p class="card-text text-end fw-bold"><span class="small fw-normal" style="font-size:10px;">税込</span>{{ number_format($goods_folder->price) }}<span class="small fw-normal" style="font-size:10px;">円～</span></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</li> 


