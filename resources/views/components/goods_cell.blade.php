
<div class=" mb-3 col-lg-6 mt-4 rounded-4 p-3">
    <div class="card contain " style="border-radius: 18px;">
        <a href="/goods/{{ $goods_folder->id }}" style="text-decoration: none; color: inherit; ">
            <div class="" style="height: 100%;">
                <div class="card-body p-0">
                    <img style="object-fit: cover; width:100%; height:320px; border-top-left-radius: 18px;border-top-right-radius: 18px;" class="image" src="{{ $goods_folder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap">    
                    <h4 class="card-title text-start fw-bold ms-3 mt-3 text-truncate font-gray" >{{ $goods_folder->name }}</h4> 
                    <p class="card-text text-wrap mt-3 text-truncate m-3 font-gray">{{ $goods_folder->description }}</p>
                    <p class="card-text fw-bold fs-3 text-nowrap mt-3 text-end me-2 font-more-gray mb-4"><span class="small fw-normal me-1" style="font-size:12px;">送料・消費税込</span>{{ $goods_folder->price }}<span class="small fw-normal me-2 " style="font-size:12px;">円～</span></p>
                </div>
            </div>
        </a>
    </div>
</div>







