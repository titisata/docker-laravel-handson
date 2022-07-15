<style>
.card-text {
    word-wrap: break-word;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="card mb-3 width: 100%;">
    <div style="display: flex; flex: 1 1 auto; height: 200px; width: 100%;">
        <a href="/experience/{{ $experienceFolder->id }}" style="text-decoration: none; color: inherit;">
            <div style="display: flex; flex: 1 1 auto; height: 100%;">
                <div class="img-square-wrapper">
                    <img style="object-fit: cover; height: 100%;" class="" src="{{ $experienceFolder->images()[0]->image_path }}" alt="Card image cap" width="200">
                </div>
                <div class="card-body" style="width: 1000px;">
                    <h4 class="card-title" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 60%;">{{ $experienceFolder->name }}</h4>
                    <p class="card-text" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 60%;">{{ $experienceFolder->description }}</p>
                    <p class="card-text">￥{{ $experienceFolder->price }}～</p>
                    <p class="card-text">{{ $experienceFolder->is_lodging ? '宿泊あり ' : '宿泊なし' }}</p>
                </div>
            </div>
        </a>
    </div>
</div>
