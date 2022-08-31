@extends('mypage.layouts.app')

@section('menu', 'site')
@section('content')

<div class="container">
    <h1>新規画像登録</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form enctype="multipart/form-data" action="/mypage/owner/action_site_image_insert/{{ $site_master->id }}" method="POST">
                @csrf
                <input type="hidden" name="table_name" value="site_masters" />
                <input type="hidden" name="table_id" value="{{ $site_master->id }}" />
                アップロード: <input name="image_path" type="file" />
                <input type="submit" value="ファイル登録" />
            </form>
        </div>
    </div>
</div>
@endsection
