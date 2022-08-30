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
    let add_count = 0;
    function add_ex(init_index) {
        let index = init_index + add_count;
        add_count++;
        const element = document.querySelector('#add_target');
        const createElement = `
            <div class="card mt-3 p-3 ex_data">
                <input hidden name="ex_ids[]" type="text" value="{{ $goods_folder->id }}">
                <div class="mb-3">
                    <label class="form-label">商品種別</label>
                    <input name="ex_names[]" type="text" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">料金</label>
                    <input name="ex_price[]" type="number" class="form-control" value="">
                </div>
                <button type="button" class="mt-2 btn btn-danger" onclick="remove_ex(${index})">削除</button>
            </div>
        `;
        element.insertAdjacentHTML('afterend', createElement);
    }
    function remove_ex(index) {
        const elements = document.querySelectorAll('.ex_data');
        elements[index].remove();
    }

</script>
<div class="container">
    <h1>イベント編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form  method="POST">
                @csrf
                <div class="card mt-3">
                    <div class="card-header">基本情報</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">商品名</label>
                            <input name="name" type="text" class="form-control" value="{{ $goods_folder->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">標準商品価格</label>
                            <input name="price" type="number" class="form-control" value="{{ $goods_folder->price }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">コメント</label>
                            <textarea name="description" type="text" class="form-control">{{ $goods_folder->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">注意事項</label>
                            <textarea name="caution" type="text" class="form-control">{{ $goods_folder->caution }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">詳細情報</label>
                            <textarea name="detail" type="text" class="form-control">{{ $goods_folder->detail }}</textarea>
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
                        <div class="mt-3">
                            <div>
                                <label>画像設定</label>
                                <a href="/mypage/partner/goods_image_insert/{{ $goods_folder->id }}">
                                    <div class="btn btn-success">
                                        新規登録     
                                    </div>
                                </a>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between">
                            @foreach($goods_folder->images() as $image)
                            <div class="d-flex flex-column col-4 my-3">
                                <img style="object-fit: cover; height: 160px; width: 160px;" src="/{{ $image->image_path ?? '/images/empty.png'}}" alt="Card image cap"> 
                                <div class="d-flex">
                                    <a href="/mypage/partner/goods_image_update/{{ $image->id }}">
                                        <div class="btn btn-primary">編集</div>
                                    </a>    
                                    <a href="/mypage/partner/goods_image_delete/{{ $image->id }}">
                                        <div class="btn btn-danger">削除</div>
                                    </a>                             
                                </div>                         
                                
                            </div>
                            @endforeach   
                        </div>        
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">詳細設定</div>
                    <div class="card-body">
                        @foreach ($goods_folder->goods as $one_goods)
                            <div class="card mt-3 p-3 ex_data">
                                <input hidden name="ex_ids[]" type="text" value="{{ $one_goods->id }}">
                                <div class="mb-3">
                                    <label class="form-label">商品種別</label>
                                    <input name="ex_names[]" type="text" class="form-control" value="{{ $one_goods->name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">料金</label>
                                    <input name="ex_price[]" type="number" class="form-control" value="{{ $one_goods->price }}">
                                </div>
                                <button type="button" class="mt-2 btn btn-danger" onclick="remove_ex({{ $loop->index }})">削除</button>
                            </div>
                        @endforeach
                        <div id="add_target"></div>
                        <button type="button" class="mt-2 btn btn-primary" onclick="add_ex({{ $goods_folder->goods->count() }})" >追加</button>
                    </div>
                </div>
                <button type="submit" class="mt-2 btn btn-primary">更新</button>
            </form>
        </div>
    </div>
</div>

@endsection
