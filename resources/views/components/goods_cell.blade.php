<style>
*{
    box-sizing:content-box;
}
.card-text {
    word-wrap: break-word;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<li class="item mx-3">
    <div  class="card shadow mb-3 rounded-3" style="max-width:300px;">
        <div  style="display: flex;max-width:270px; ">
            <a href="/goods/{{ $goods_folder->id }}" style="text-decoration: none; color: inherit;">
                <div style="display: flex; flex: 1 1 auto; height: 100%; max-width:270px; flex-direction:column;"">
                    <div class="img-square-wrapper">
                        <img style="object-fit: cover; width:270px;height: 180px;" class="rounded-top" src="{{ $goods_folder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap" width="270">
                    </div>
                    <div class="card-header border-none" style="background:white;border-bottom:none">
                        <h4 class="card-title text-center mb-0 text-truncate" >{{ $goods_folder->name }}</h4>
                    </div>
                    <div class="card-body">
                        
                        <p class="card-text">￥{{ $goods_folder->price }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</li>




