@extends('mypage.layouts.app')

@section('menu', 'site')
@section('content')
<style>
    .number_form{
        width:60px;
    }
</style>
<div class="container">
    <h1>サイト管理</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">サイト情報</div>
                <div class="card-body">
                    <form action="/mypage/owner/site" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">サイトの名前</label>
                            <input name="site_name" type="text" class="form-control" value="{{ $site_master->site_name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">開店状況</label>
                            <input name="open_flag" type="radio" class="" value="{{ $site_master->open_flag }}">
                            <label>オープン</label>
                            <input name="open_flag" type="radio" class="" value="{{ $site_master->open_flag }}">
                            <label>閉館</label>
                            <input name="open_flag" type="radio" class="" value="{{ $site_master->open_flag }}">
                            <label>準備中</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">機能情報</label>
                            <input name="service" type="radio" class="" value="{{ $site_master->service }}">
                            <label>全機能</label>
                            <input name="service" type="radio" class="" value="{{ $site_master->service }}">
                            <label>予約機能のみ</label>
                            <input name="service" type="radio" class="" value="{{ $site_master->service }}">
                            <label>EC機能のみ</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">登録可能店舗数</label>
                            <input name="shop_num" type="number" class="form-control number_form" value="{{ $site_master->shop_num }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">商品登録上限数</label>
                            <input name="regist_num" type="number" class="form-control number_form" value="{{ $site_master->regist_num }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">おすすめ表示上限</label>
                            <input name="recommend_limit" type="number" class="form-control number_form" value="{{ $site_master->recommend_limit }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">コメント</label>
                            <textarea name="comment" type="text" class="form-control">{{ $site_master->comment }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">メイン画像</label>
                            <input name="main_image" type="text" class="form-control" value="{{ $site_master->main_image }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">サイトカラー</label>
                            <input name="site_color" type="text" class="form-control" value="{{ $site_master->site_color }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">キャッチコピー</label>
                            <input name="sales_copy" type="text" class="form-control" value="{{ $site_master->sales_copy }}">
                        </div>
                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection