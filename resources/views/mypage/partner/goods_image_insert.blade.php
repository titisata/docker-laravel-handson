@extends('mypage.layouts.app')

@section('menu', 'partner_event')
@section('content')

<div class="container">
    <h1>新規画像登録</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form enctype="multipart/form-data" action="/mypage/partner/action_goods_image_insert/{{ $goods_folder->id }}" method="POST">
                @csrf
                <input type="hidden" name="table_name" value="goods_folders" />
                <input type="hidden" name="table_id" value="{{ $goods_folder->id }}" />
                アップロード: <input name="image_path" type="file" />
                <button class="btn btn-primary mt-4">ファイル登録</button>
            </form>
        </div>
    </div>
</div>
@endsection
