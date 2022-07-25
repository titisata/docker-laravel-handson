<style>
*{
    box-sizing:content-box;
}
.card-text {
    word-wrap: break-word;
}
.cotain{
    height:200px
}

.card-title{
    width:600px;

}
.image{
    width:400px;
}
@media screen and (max-width:1400px) {
    .card-title{
        width:400px;

    }


}    

@media screen and (max-width:992px) {
    .cotain{
        height:360px;
        width:400px;
    } 
    .card-title{
        width:100%;

    }

    .img_box{
        width:100%;

    }

    .image{
        width:100%;
    }
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">


<div class="card mb-3">
    <div class="contain">
        <a href="/experience/{{ $experienceFolder->id }}?{{ explode('?', str_replace(url('/'),"",request()->fullUrl()))[1] }}" style="text-decoration: none; color: inherit;">
            <div class="d-lg-flex  justify-content-between"style="height: 100%; ">
                <div class="img-square-wrapper img_box">
                    <img style="object-fit: cover; height: 200px; " class="rounded-top image" src="{{ $experienceFolder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap">
                </div>
                <div class="card-body d-flex flex-column">    
                    <h5 class="card-title text-start mb-0 text-truncate" >{{ $experienceFolder->name }}</h5> 
                    <p class="card-text fw-bold fs-4 text-nowrap text-end mt-auto">￥{{ $experienceFolder->price_child }}～</p>
                    <p class="card-text text-end">{{ $experienceFolder->is_lodging ? ('宿泊日: ' . ($experienceFolder->is_before_lodging ?  (new DateTime(app('request')->input('keyword')))->modify("-1day")->format('Y-m-d') . ' (前泊)' : app('request')->input('keyword') . ' (後泊)') ) : '宿泊なし' }}</p>
                </div>
            </div>
        </a>
    </div>
</div>

