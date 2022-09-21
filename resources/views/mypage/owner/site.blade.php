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
                            @error('site_name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="site_name" type="text" class="form-control" value="{{ $site_master->site_name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">開店状況</label>
                            <input name="open_flag" type="radio" class="" checked value="{{ $site_master->open_flag }}">
                            <label>オープン</label>
                            <input name="open_flag" type="radio" class="" value="{{ $site_master->open_flag }}">
                            <label>閉館</label>
                            <input name="open_flag" type="radio" class="" value="{{ $site_master->open_flag }}">
                            <label>準備中</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">機能情報</label>
                            <input name="service" type="radio" class="" checked  value="{{ $site_master->service }}">
                            <label>全機能</label>
                            <input name="service" type="radio" class="" value="{{ $site_master->service }}">
                            <label>予約機能のみ</label>
                            <input name="service" type="radio" class="" value="{{ $site_master->service }}">
                            <label>EC機能のみ</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">登録可能店舗数</label>
                            @error('shop_num')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="shop_num" type="number" class="form-control number_form" value="{{ $site_master->shop_num }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">商品登録上限数</label>
                            @error('regist_num')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="regist_num" type="number" class="form-control number_form" value="{{ $site_master->regist_num }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">おすすめ表示上限</label>
                            @error('recommend_limit')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="recommend_limit" type="number" class="form-control number_form" value="{{ $site_master->recommend_limit }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">コメント</label>
                            @error('comment')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="comment" type="text" class="form-control">{{ $site_master->comment }}</textarea>
                        </div>
                        <div class="mt-3">
                            <div>
                                <label>画像設定</label>
                                <a href="/mypage/owner/site_image_insert/{{ $site_master->id }}">
                                    <div class="btn btn-success">
                                        新規登録     
                                    </div>
                                </a>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between">
                            @forelse($site_master->images() as $image)
                            <div class="d-flex flex-column col-4 my-3">
                                <img class="card-img" style="width: 200px;height: 140px; object-fit: cover;" src="{{ $image->image_path }}" alt=""> 
                                <div class="d-flex">
                                    <a href="/mypage/owner/site_image_update/{{ $image->id }}">
                                        <div class="btn btn-primary">編集</div>
                                    </a>    
                                    <a href="/mypage/owner/site_image_delete/{{ $image->id }}">
                                        <div class="btn btn-danger">削除</div>
                                    </a>                             
                                </div>                         
                                
                            </div>        
                            
                            @empty
                                <p>no post data</p>
                                
                            @endforelse
                        </div>
                        <div class="mb-3">
                            <label class="form-label">サイトカラー</label>
                            <input name="site_color" type="text" class="form-control" value="{{ $site_master->site_color }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">キャッチコピー</label>
                            @error('sales_copy')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
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