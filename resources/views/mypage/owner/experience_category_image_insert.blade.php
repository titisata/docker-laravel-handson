@extends('mypage.layouts.app')

@section('menu', 'site')
@section('content')

<div class="container">
    <h1>新規画像登録</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form enctype="multipart/form-data" action="/mypage/owner/action_experience_category_image_insert/{{ $experience_category->id }}" method="POST">
                @csrf
                <input type="hidden" name="table_name" value="experience_category" />
                <input type="hidden" name="table_id" value="{{ $experience_category->id }}" />
                アップロード: <input name="image_path" type="file" />
                <input type="submit" value="ファイル登録" />
            </form>
        </div>
    </div>
</div>
@endsection
