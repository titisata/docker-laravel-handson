<style>
.card-text {
    word-wrap: break-word;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="card mb-3 " style="max-width:300px;" >
        <!-- <div style="display: flex; flex: 1 1 auto; height: 200px; width: 100%; flex-direction:column;"> -->
        <div style="display: flex;max-width:300px; ">
            <a href="/experience/{{ $experienceFolder->id }}" style="text-decoration: none; color: inherit;">
                <div style="display: flex; flex: 1 1 auto; height: 100%;max-width:300px; flex-direction:column;">
                    <div class="img-square-wrapper">
                        <img style="object-fit: cover; width: 100%;height: 200px;" class="" src="{{ $experienceFolder->images()[0]->image_path }}" alt="Card image cap" width="200">
                    </div>
                    <div class="card-header">
                        <h5 class="card-title text-center mb-0" >{{ $experienceFolder->name }}</h5>
                    </div>
                    <div class="card-body" >
                        <!-- <p class="card-text" >{{ $experienceFolder->description }}</p> -->
                        <p class="card-text text-end fw-bold fs-4">￥{{ $experienceFolder->price }}～</p>
                        <p class="card-text text-end fw-bold fs-6">{{ $experienceFolder->is_lodging ? '宿泊あり ' : '宿泊なし' }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>



