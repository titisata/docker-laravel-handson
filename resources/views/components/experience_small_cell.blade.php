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
    <div class="card shadow mb-3 rounded-3" style="max-width:270px;" >
        <!-- <div style="display: flex; flex: 1 1 auto; height: 200px; width: 100%; flex-direction:column;"> -->
        <div style="display: flex;max-width:270px; ">
            <a href="/experience/{{ $experienceFolder->id }}" style="text-decoration: none; color: inherit;">
                <div style="display: flex; flex: 1 1 auto; height: 100%;max-width:270px; flex-direction:column;">
                    <div class="img-square-wrapper">
                        <img style="object-fit: cover; width:270px;height: 180px;" class="rounded-top" src="{{ $experienceFolder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap" width="200">
                    </div>
                    <div class="card-header border-none" style="background:white;border-bottom:none">
                        <h5 class="card-title text-center mb-0 text-truncate" >{{ $experienceFolder->name }}</h5>
                    </div>
                    <div class="card-body">
                        <!-- <p class="card-text" >{{ $experienceFolder->description }}</p> -->
                        <p class=" mb-0 card-text text-end fw-bold fs-5">　大人：{{ $experienceFolder->price_adult }}円～</p>
                        <p class="card-text text-end fw-bold fs-5">子ども：{{ $experienceFolder->price_child }}円～</p>
                        <!-- <p class="card-text text-end fw-bold fs-6">{{ $experienceFolder->is_lodging ? '宿泊あり ' : '宿泊なし' }}</p> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
</li>



