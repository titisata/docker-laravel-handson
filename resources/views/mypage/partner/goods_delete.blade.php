@extends('mypage.layouts.app')

@section('menu', 'partner_event')
@section('content')
<div class="container">
    <h1>イベント削除</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/mypage/partner/action_goods_delete/{{ $goods->id }}" method="POST">
                @csrf
                <div class="card mt-3">
                    <div class="card-header">商品設定</div>
                    <div class="card-body">
                    <div class="card mt-3 p-3 goods_data">
                        <input hidden name="goods_ids" type="text" value="{{ $goods->id }}">
                        <input hidden name="goods_folder_ids" type="text" value="{{ $goods->goods_folder_id }}">
                        <div class="mb-3">
                            <label class="form-label">商品種別</label>
                            <input name="goods_names" type="text" class="form-control" value="{{ $goods->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">料金</label>
                            <input name="goods_prices" type="number" class="form-control" value="{{ $goods->price }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">コメント</label>
                            <textarea name="goods_descriptions" type="text" class="form-control">{{ $goods->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">個数</label>
                            <input name="goods_quantities" type="number" class="form-control" value="{{ $goods->quantity }}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="mt-2 btn btn-danger">削除</button>
            </form>
        </div>
    </div>
</div>
@endsection
