@extends('mypage.layouts.app')

@section('menu', 'partner_new')
@section('content')
<style>
    .number_form{
        width:60px;
    }
</style>
<div class="container">
    <h1>パートナー管理</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card mt-3">
                <div class="card-header">新規パートナー情報</div>
                <div class="card-body">
                    <form action="/mypage/owner/partner_display" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">パートナー名</label>
                            <input name="name" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">稼働日情報</label>
                            <input name="reserve_flag" type="radio" class="" value="0">
                            <label>稼働日登録なし</label>
                            <input name="reserve_flag" type="radio" class="" value="1">
                            <label>稼働日登録あり</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">機能情報</label>
                            <input name="service" type="radio" class="" value="0">
                            <label>全機能</label>
                            <input name="service" type="radio" class="" value="1">
                            <label>予約機能のみ</label>
                            <input name="service" type="radio" class="" value="2">
                            <label>EC機能のみ</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">商品登録上限数</label>
                            <input name="regist_num" type="number" class="form-control number_form" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">コメント</label>
                            <textarea name="description" type="text" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">メイン画像</label>
                            <input name="main_image" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">背景色</label>
                            <input name="background_color" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">キャッチコピー</label>
                            <input name="catch_copy" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">住所</label>
                            <input name="address" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">電話番号</label>
                            <input name="phone" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">アクセス</label>
                            <input name="access" type="text" class="form-control" value="">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">追加</button>
                    </form>
            
                </div>
            </div>  
        </div>
    </div>
</div>

@endsection