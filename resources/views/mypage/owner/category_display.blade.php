@extends('mypage.layouts.app')

@section('menu', 'category')
@section('content')

<style>
    .number_form{
        width:60px;
    }
</style>
<div class="container">
    <h1>カテゴリー編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">体験カテゴリー編集</div>
                <div class="card-body">
                    <form action="/mypage/owner/action_experience_category_display" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">新しい体験カテゴリー名</label>
                            <div class="d-flex" style="width:300px">
                                <input name="name" type="text" class="form-control" value="">
                                <button type="submit" class="btn btn-primary">追加</button>
                            </div>
                        </div>                     
                    </form>

                    <p>現在表示されている体験カテゴリ</p>
                    @foreach ($experience_categories as $experience_category)
                    <div class='d-flex my-2'>
                        <form action="/mypage/owner/action_experience_category_update" method="POST">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="name" class="form-control form-control-sm" value="{{ $experience_category->name }}">
                                <button type="submit" class="btn btn-sm btn-primary mx-2" name="update">更新</button>
                                <input type="hidden" name="id" value="{{ $experience_category->id }}">
                            </div>
                           
                        </form>
                        
                        <form action="/mypage/owner/action_experience_category_delete" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger mx-2" style="height:34px;" name="delete">削除</button>
                            <input type="hidden" name="id" value="{{ $experience_category->id }}">
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">お土産カテゴリー編集</div>
                <div class="card-body">
                    <form action="/mypage/owner/action_goods_category_insert" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">新しいお土産カテゴリー名</label>
                            <div class="d-flex" style="width:300px">
                                <input name="name" type="text" class="form-control" value="">
                                <button type="submit" class="btn btn-primary">追加</button>
                            </div>
                            
                        </div>  
                    </form>

                    <p>現在表示されているお土産カテゴリ</p>
                    @foreach ($goods_categories as $goods_category)
                    <div class='d-flex my-2'>
                        <form action="/mypage/owner/action_goods_category_update" method="POST">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="name" class="form-control form-control-sm" value="{{ $goods_category->name }}">
                                <button type="submit" class="btn btn-sm btn-primary mx-2" name="update">更新</button>
                                <input type="hidden" name="id" value="{{ $goods_category->id }}">
                            </div>
                            
                        </form>
                        
                        <form action="/mypage/owner/action_goods_category_delete" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger mx-2" style="height:34px;" name="delete">削除</button>
                            <input type="hidden" name="id" value="{{ $goods_category->id }}">
                        </form>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection