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
.card-text{
    width:600px;
}
.image{
    width:400px;
}
@media screen and (max-width:1400px) {
    .card-title {
        width:100%;

    }

    .card-text{
        width:360px;
    }

    


}    

@media screen and (max-width:992px) {
    .cotain{
        height:360px;
        width:100%;
    } 

    .card-text{
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
        <a href="/goods/{{ $goods_folder->id }}" style="text-decoration: none; color: inherit;">
            <div class="d-lg-flex justify-content-between"style="height: 100%; ">
                <div class="img-square-wrapper img_box">
                    <img style="object-fit: cover; height: 200px; " class="rounded-top image" src="/storage/{{ $goods_folder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap" width="200">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-start mb-0 text-truncate">{{ $goods_folder->name }}</h5>
                    <p class="card-text text-end mt-auto text-truncate">{{ $goods_folder->description }}</p>
                    <p class="card-text fw-bold fs-4 text-nowrap text-end mt-auto">￥{{ $goods_folder->price }}~</p>
                </div>
            </div>
        </a>
    </div>
</div>







