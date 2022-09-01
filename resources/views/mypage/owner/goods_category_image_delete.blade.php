@extends('mypage.layouts.app')

@section('menu', '')
@section('content')

<div class="container">
    <h1>画像削除</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form enctype="multipart/form-data"  action="/mypage/owner/action_goods_category_image_delete/{{ $images->id }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $images->id }}" />
                <input type="hidden" name="table_id" value="{{ $images->table_id }}" />
                <input type="hidden" name="image_path" value="{{ $images->image_path }}" />
                <img src="{{ $images->image_path }}" alt="" style="width: 200px;height: 140px; object-fit: cover;">
                <p>{{ $images->image_path }}</p>
                <input type="submit" value="画像を削除します" />
            </form>
        </div>
    </div>
</div>
@endsection
