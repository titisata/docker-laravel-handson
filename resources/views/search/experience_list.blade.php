@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-3">検索結果</h3>

            <form action="/search/experience" method="get">
                <label for="keyword">ワード</label><input name="keyword" type="text">
            </form>

            @forelse($experinceFolders as $experinceFolder)
                @include('components.experience_cell', ['experinceFolder'=>$experinceFolder])
            @empty
                <p>検索結果がありません。</p>
            @endforelse
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <div>{{ $experinceFolders->appends(request()->query())->links('pagination::bootstrap-4') }}</div>
    </div>
</div>

@endsection
