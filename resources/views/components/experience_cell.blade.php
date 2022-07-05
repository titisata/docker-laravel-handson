<style>
.card {
    max-width: 100%;
}
.card-text {
    word-wrap: break-word;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="card mb-3">
    <div style="display: flex; flex: 1 1 auto; height: 200px;">
        <a href="/experience/{{ $experinceFolder->id }}?{{ explode('?', str_replace(url('/'),"",request()->fullUrl()))[1] }}" style="text-decoration: none; color: inherit;">
            <div style="display: flex; flex: 1 1 auto; height: 100%;">
                <div class="img-square-wrapper">
                    <img style="object-fit: cover; height: 100%;" class="" src="{{ $experinceFolder->images()[0]->image_path }}" alt="Card image cap" width="200">
                </div>
                <div class="card-body" style="max-width: 100%;">
                    <h4 class="card-title" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 60%;">{{ $experinceFolder->name }}</h4>
                    <p class="card-text" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 60%;">{{ $experinceFolder->description }}</p>
                    <p class="card-text">￥{{ $experinceFolder->price }}～</p>
                    <p class="card-text">{{ $experinceFolder->is_lodging ? '宿泊あり ' . '宿泊日: ' . app('request')->input('keyword') : '宿泊なし' }}</p>
                    <p>開催日: {{ app('request')->input('keyword') }}</p>
                </div>
            </div>
        </a>
    </div>
</div>
