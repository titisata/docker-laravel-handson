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
    <div style="display: flex; flex: 1 1 auto; height: 150px;">
        <a href="/experience/{{ $experinceFolder->id }}" style="text-decoration: none; color: inherit;">
            <div style="display: flex; flex: 1 1 auto;  height: 100%;">
                {{-- <div class="img-square-wrapper">
                    <img style="object-fit: cover; height: 100%;" class="" src="{{ $place->images[0]->image_path ?? "/images/placeholder1.png" }}" alt="Card image cap" width="200">
                </div> --}}
                <div class="card-body">
                    <h4 class="card-title">{{ $experinceFolder->name }}</h4>
                    <p class="card-text">{{ $experinceFolder->description }}</p>
                </div>
            </div>
        </a>
    </div>
</div>
