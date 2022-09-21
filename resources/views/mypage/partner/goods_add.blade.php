@extends('mypage.layouts.app')

@section('menu', 'goods_edit')
@section('content')
<script>
    $(function(){
        $('textarea')
            .on('input', function(){
                if ($(this).outerHeight() > this.scrollHeight){
                    $(this).height(1)
                }
                while ($(this).outerHeight() < this.scrollHeight){
                    $(this).height($(this).height() + 1)
                }
            });
    });

</script>
<div class="container">
    <h1>お土産編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/mypage/partner/action_goods_add" method="POST">
                @csrf
                <input name="user_id" type="hidden" value="{{ $user->id }}" >
                <div class="card mt-3">
                    <div class="card-header">基本情報</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">商品名</label>
                            <input name="name" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">標準商品価格</label>
                            <input name="price" type="number" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">コメント</label>
                            <textarea name="description" type="text" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">注意事項</label>
                            <textarea name="caution" type="text" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">詳細情報</label>
                            <textarea name="detail" type="text" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                        <label class="form-label">カテゴリ</label>
                        <select name="category" class="form-select mt-2" style="width:216px">
                            @foreach ($categories as $category)
                                <option @if ($goods_folder->category == $category->name) selected @endif value="{{ $category->name }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">おすすめフラグ</label>
                            @if( $goods_folder->recommend_flag  == 1)
                                <input name="recommend_flag" type="radio" class="" checked value="1">
                                <label>おすすめする</label>
                                <input name="recommend_flag" type="radio" class="" value="0">
                                <label>おすすめしない</label>
                            @else
                                <input name="recommend_flag" type="radio" class="" value="1">
                                <label>おすすめする</label>
                                <input name="recommend_flag" type="radio" class="" checked value="0">
                                <label>おすすめしない</label>
                            @endif
                        </div>
                            
                    </div>
                </div>
                <button type="submit" class="mt-2 btn btn-primary">更新</button>
            </form>
        </div>
    </div>
</div>

@endsection
