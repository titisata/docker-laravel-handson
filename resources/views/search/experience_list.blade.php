@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-3">体験検索結果</h3>

            <form action="/search/experience" method="get">
                <label for="keyword">日付</label><input name="keyword" type="date">
                <input type="submit" value="検索">
            </form>

            @forelse($experienceFolders as $experienceFolder)
                @if (!$experienceFolder->is_holiday(app('request')->input('keyword')))
                    @include('components.experience_cell', ['experienceFolder'=>$experienceFolder])
                @endif
            @empty
                <p>検索結果がありません。</p>
            @endforelse
            <!-- <a href="/search/goods">土産検索へ</a> -->
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <div>{{ $experienceFolders->appends(request()->query())->links('pagination::bootstrap-4') }}</div>
    </div>
</div>

@endsection
