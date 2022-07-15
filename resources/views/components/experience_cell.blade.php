<style>
.card-text {
    word-wrap: break-word;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="card mb-3 width: 100%;">
    <div style="display: flex; flex: 1 1 auto; height: 200px; width: 100%;">
        <a href="/experience/{{ $experinceFolder->id }}?{{ explode('?', str_replace(url('/'),"",request()->fullUrl()))[1] }}" style="text-decoration: none; color: inherit;">
            <div style="display: flex; flex: 1 1 auto; height: 100%;">
                <div class="img-square-wrapper">
                    <img style="object-fit: cover; height: 100%;" class="" src="{{ $experinceFolder->images()[0]->image_path }}" alt="Card image cap" width="200">
                </div>
                <div class="card-body" style="width: 1000px;">
                    <h4 class="card-title" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 60%;">{{ $experinceFolder->name }}</h4>
                    <p class="card-text" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 60%;">{{ $experinceFolder->description }}</p>
                    <p class="card-text">￥{{ $experinceFolder->price }}～</p>
                    <p>開催日: {{ app('request')->input('keyword') }}</p>
                    <p class="card-text">{{ $experinceFolder->is_lodging ? ('宿泊日: ' . ($experinceFolder->is_before_lodging ?  (new DateTime(app('request')->input('keyword')))->modify("-1day")->format('Y-m-d') . ' (前泊)' : app('request')->input('keyword') . ' (後泊)') ) : '宿泊なし' }}</p>
                </div>
            </div>
        </a>
    </div>
</div>
