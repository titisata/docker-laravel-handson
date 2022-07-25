<style>
*{
    box-sizing:content-box;
}
.card-text {
    word-wrap: break-word;
}
.contain{
    height:220px;
    width: 100%;
}

.image{
    width:300px;
    object-fit: cover;
    height: 100%;
}

/* .box{
    max-width:1000px;

}

.img_box{
    max-width:40%;
}

.text_box{
    max-width:60%;

}

@media screen and (max-width:992px) {
    .box{
        max-width:500px;

    }
    .contain{
        height:500px;
        width: 100%; 
    }
    .image{
    width:100%;
    object-fit: cover;
    height: 240px;
    }
    .img_box{
        max-width:100%;
    }

    .text_box{
        max-width:100%;

    }
} */

</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="card mb-3 width: 100%;">
    <div style="display: flex; flex: 1 1 auto; height: 200px; width: 100%;">
        <a href="/goods/{{ $goods_folder->id }}" style="text-decoration: none; color: inherit;">
            <div style="display: flex; flex: 1 1 auto; height: 100%;">
                <div class="img-square-wrapper">
                    <img style="object-fit: cover; height: 100%;" class="" src="{{ $goods_folder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap" width="200">
                </div>
                <div class="card-body" style="max-width: 1000px;">
                    <h4 class="card-title" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 60%;">{{ $goods_folder->name }}</h4>
                    <p class="card-text" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 60%;">{{ $goods_folder->description }}</p>
                    <p class="card-text">￥{{ $goods_folder->price }}</p>
                </div>
            </div>
        </a>
    </div>
</div>




