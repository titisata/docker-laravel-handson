<style>
.card-text {
    word-wrap: break-word;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- <div class="card mb-3 width: 100%;">
    <div style="display: flex; flex: 1 1 auto; height: 200px; width: 100%;">
        <a href="/goods/{{ $goods->id }}" style="text-decoration: none; color: inherit;">
            <div style="display: flex; flex: 1 1 auto; height: 100%;">
                <div class="img-square-wrapper">
                    <img style="object-fit: cover; height: 100%;" class="" src="{{ $goods->images()[0]->image_path }}" alt="Card image cap" width="200">
                </div>
                <div class="card-body" style="width: 1000px;">
                    <h4 class="card-title" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 60%;">{{ $goods->name }}</h4>
                    <p class="card-text" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 60%;">{{ $goods->description }}</p>
                    <p class="card-text">￥{{ $goods->price }}</p>
                </div>
            </div>
        </a>
    </div>
</div> -->

<div class="card mb-3 shadow rounded-3" style="max-width:300px;" >
        
        <div style="display: flex;max-width:300px; ">
            <a href="/goods/{{ $goods->id }}" style="text-decoration: none; color: inherit;">
                <div style="display: flex; flex: 1 1 auto; height: 100%;max-width:300px; flex-direction:column;">
                    <div class="img-square-wrapper">
                        <img style="object-fit: cover; width: 270px;height: 200px;" class="rounded-top" src="{{ $goods->images()[0]->image_path }}" alt="Card image cap" width="200">
                    </div>
                    <div class="card-header border-none" style="background:white;border-bottom:none">
                        <h5 class="card-title text-center mb-0 text-truncate" >{{ $goods->name }}</h5>
                    </div>
                    <div class="card-body pt-5" >
    
                        <p class="card-text text-end fw-bold fs-4">￥{{ $goods->price }}</p>
                    
                    </div>
                </div>
            </a>
        </div>
    </div>

