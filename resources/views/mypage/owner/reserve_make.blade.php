@extends('mypage.layouts.app')

@section('menu', 'owner_reserve_make')
@section('content')
<div class="container">
    <h1>新規イベント予約作成</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card mt-3">
                <div class="card-header">新規イベント登録</div>
                <div class="card-body">
                    <form action="/mypage/owner/reserve_make/{id}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">イベント名</label>
                            <input name="name" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">コメント</label>
                            <input  type="text" class="form-control" value="">
                            <textarea name="description" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">アドレス</label>
                            <input name="address" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">注意事項</label>
                            <input name="caution" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">詳細情報</label>
                            <input name="detail" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">カテゴリー選択1</label>
                            <input name="category1" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">カテゴリー選択2</label>
                            <input name="category2" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">カテゴリー選択3</label>
                            <input name="category3" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">宿泊</label>
                            <input name="is_loding" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">宿泊詳細</label>
                            <input name="is_before_loding" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">子供料金</label>
                            <input name="price_child" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">大人料金</label>
                            <input name="price_adult" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">おすすめフラグ</label>
                            <input name="reccomend_flag" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">おすすめ順</label>
                            <input name="reccomend_sort_no" type="text" class="form-control" value="">
                        </div>
                       
                        <button type="submit" class="btn btn-primary">追加</button>
                    </form>
            
                </div>
            </div>  
        </div>
    </div>
    
</div>
@endsection
