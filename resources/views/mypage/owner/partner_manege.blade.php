@extends('mypage.layouts.app')

@section('menu', 'partner_manege')
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
                <div class="card-header">パートナー情報</div>
                <div class="card-body">
                    <form action="/mypage/owner/partner_manege_update/{id}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">パートナー名</label>
                            <input name="name" type="text" class="form-control" value="{{ $partners->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">稼働日情報</label>
                            <input name="reserve_flag" type="radio" class="" checked value="{{ $partners->reserve_flag }}">
                            <label>稼働日登録なし</label>
                            <input name="reserve_flag" type="radio" class="" value="{{ $partners->reserve_flag }}">
                            <label>稼働日登録あり</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">機能情報</label>
                            <input name="service" type="radio" class="" checked value="{{ $partners->service }}">
                            <label>全機能</label>
                            <input name="service" type="radio" class="" value="{{ $partners->service }}">
                            <label>予約機能のみ</label>
                            <input name="service" type="radio" class="" value="{{ $partners->service }}">
                            <label>EC機能のみ</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">商品登録上限数</label>
                            <input name="regist_num" type="number" class="form-control number_form" value="{{ $partners->regist_num }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">コメント</label>
                            <textarea name="description" type="text" class="form-control">{{ $partners->description }}</textarea>
                        </div>
                        <div class="mt-3">
                            <div>
                                <label>画像設定</label>
                                
                            </div>
                            <div class="d-flex flex-wrap justify-content-between">
                            @forelse($partners->images() as $image)
                            <div class="d-flex flex-column col-4 my-3">
                                <img class="card-img" style="width: 200px;height: 140px; object-fit: cover;" src="{{ $image->image_path ?? '/images/empty.png'}}" alt=""> 
                                <div class="d-flex">
                                    <a href="/mypage/owner/partner_image_update/{{ $image->id }}">
                                        <div class="btn btn-primary">編集</div>
                                    </a>    
                                    <a href="/mypage/owner/partner_image_delete/{{ $image->id }}">
                                        <div class="btn btn-danger">削除</div>
                                    </a>                             
                                </div>                         
                                
                            </div>        
                            
                            @empty
                                <a href="/mypage/owner/partner_image_insert/{{ $partners->id }}">
                                    <div class="btn btn-success">
                                        新規登録     
                                    </div>
                                </a>
                                
                            @endforelse
                        </div>
                        <div class="mb-3">
                            <label class="form-label">背景色</label>
                            <input name="background_color" type="text" class="form-control" value="{{ $partners->background_color }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">キャッチコピー</label>
                            <input name="catch_copy" type="text" class="form-control" value="{{ $partners->catch_copy }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">住所</label>
                            <input name="address" type="text" class="form-control" value="{{ $partners->address }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">電話番号</label>
                            <input name="phone" type="text" class="form-control" value="{{ $partners->phone }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">アクセス</label>
                            <input name="access" type="text" class="form-control" value="{{ $partners->access }}">
                        </div>
                        <input type="hidden" name="id" value="{{ $partners->id }}">
                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                    <form action="/mypage/owner/partner_manege_delete/{id}" method="POST" class='my-2'>
                        @csrf
                        <input type="hidden" name="id" value="{{ $partners->id }}">
                        <input name="name" type="hidden" class="form-control" value="{{ $partners->name }}">
                        <input name="description" type="hidden" class="form-control" value="{{ $partners->description}}">
                        <input name="background_color" type="hidden" class="form-control" value="{{ $partners->background_color }}">
                        <input name="catch_copy" type="hidden" class="form-control" value="{{ $partners->catch_copy }}">
                        <input name="address" type="hidden" class="form-control" value="{{ $partners->address }}">
                        <input name="phone" type="hidden" class="form-control" value="{{ $partners->phone }}">
                        <input name="access" type="hidden" class="form-control" value="{{ $partners->access }}">
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
            
                </div>
            </div>  
        </div>
    </div>
</div>

@endsection