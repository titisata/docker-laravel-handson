@extends('mypage.layouts.app')

@section('menu', 'site')
@section('content')

<div class="container">
    <h1>画像編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form enctype="multipart/form-data"  action="/mypage/owner/action_experience_category_image_update/{{ $images->id }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $images->id }}" />
                <input type="hidden" name="table_id" value="{{ $images->table_id }}" />
                <input type="hidden" name="delete_path" value="{{ $images->image_path }}" />
                <input type="hidden" name="table_name" value="{{ $images->table_name }}" />
                <p>現在表示されている画像</p>
                <img src="{{ $images->image_path }}" alt="" style="width: 200px;height: 140px; object-fit: cover;">
                <p></p>
                <div>更新したい画像: <input name="image_path" type="file" /></div>
                <input type="submit" value="ファイル更新" />
            </form>
        </div>
    </div>
</div>
@endsection
