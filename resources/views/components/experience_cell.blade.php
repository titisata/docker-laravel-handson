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
    <div style="display: flex; flex: 1 1 auto;">
        <a href="/experience/{{ $experinceFolder->id }}?{{ explode('?', str_replace(url('/'),"",request()->fullUrl()))[1] }}" style="text-decoration: none; color: inherit;">
            <div class="card-body">
                <h4 class="card-title">{{ $experinceFolder->name }}</h4>
                <p class="card-text">{{ $experinceFolder->description }}</p>
                <p class="card-text">￥{{ $experinceFolder->price }}～</p>
                <p class="card-text">{{ $experinceFolder->is_lodging ? '宿泊あり ' . '宿泊日: ' . app('request')->input('keyword') : '宿泊なし' }}</p>
            </div>
        </a>
    </div>
</div>
