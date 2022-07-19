<style>
.card-text {
    word-wrap: break-word;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="card shadow-sm">
    <div class="card-body">
        <div class="g-mb-15 d-flex justify-content-between">
            <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $comment->user->name }}  @for ($i = 0; $i < $comment->rate; $i++)★@endfor</h5>
            <span class="small">{{ $comment->created_at }}</span>
        </div>
        <p class="mt-3">{{ $comment->content }}</p>
    </div>
</div>

