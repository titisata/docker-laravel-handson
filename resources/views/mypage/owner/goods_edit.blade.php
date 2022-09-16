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
        let key_count = 0;
        let index = init_index + add_count;
        add_count++;
        key_count++;
        let key = parseInt(document.getElementById('key').value); 
        key = key + key_count;
        const element = document.querySelector('#add_target');
        const createElement = `
            <div class="card mt-3 p-3 ex_data" id="data_` + key + `">
                <input name="goods_ids" type="hidden" value="">
                <div class="mb-3">
                    <label class="form-label">商品種別</label>
                    <input name="goods_names_` + key + `" type="text" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">料金</label>
                    <input name="goods_pricies_` + key + `" type="number" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">コメント</label>
                    <textarea name="goods_descriptions_` + key + `" type="text" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">ソートナンバー</label>
                    <input name="goods_sort_nos_` + key + `" type="number" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">個数</label>
                    <input name="goods_quantities_` + key + `" type="number" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">体験の表示・非表示</label>
                    <input name="goods_statuses_` + key + `" type="radio" checked value="1">
                    <label>表示</label>
                    <input name="goods_statuses_` + key + `" type="radio" value="0">
                    <label>非表示</label>
                </div>
                <button type="button" class="mt-2 btn btn-danger" onclick="remove_goods(${key})">削除</button>
            </div>
        `;

        document.getElementById('key').value = key;
        element.insertAdjacentHTML('beforeend', createElement);
    }
    
    function remove_goods(key) {
        var delete_id = 'data_' + key;
        const elements = document.getElementById(delete_id);
        elements.remove();
    }

</script>
<div class="container">
    <h1>お土産編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/mypage/owner/goods_edit_update" method="POST">
                @csrf
                <input name="id" type="hidden" class="form-control" value="{{ $goods_folder->id }}">
                <input name="partner_id" type="hidden" class="form-control" value="{{ $goods_folder->partner_id }}">
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
                        <select name="category1" class="form-select mt-2" style="width:216px">
                            @foreach ($categories as $category)
                                <option @if ($goods_folder->category == $category->name) selected @endif value="{{ $category->name }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                        <div class="mb-3">
                            <label class="form-label">お土産の表示・非表示</label>
                            @if( $goods_folder->status  == 1 )
                                <input name="status" type="radio" class="" checked value="1">
                                <label>表示</label>
                                <input name="status" type="radio" class="" value="0">
                                <label>非表示</label>
                            @else
                                <input name="status" type="radio" class="" value="1">
                                <label>表示</label>
                                <input name="status" type="radio" class="" checked value="0">
                                <label>非表示</label>
                            @endif
                            
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
                        <div class="mt-3">
                            <div>
                                <label>画像設定</label>
                                <a href="/mypage/owner/goods_image_insert/{{ $goods_folder->id }}">
                                    <div class="btn btn-success">
                                        新規登録     
                                    </div>
                                </a>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between">
                            @foreach($goods_folder->images() as $image)
                            <div class="d-flex flex-column col-4 my-3">
                                <img style="object-fit: cover; height: 160px; width: 160px;" src="{{ $image->image_path ?? '/images/empty.png'}}" alt="Card image cap"> 
                                <div class="d-flex">
                                    <a href="/mypage/owner/goods_image_update/{{ $image->id }}">
                                        <div class="btn btn-primary">編集</div>
                                    </a>    
                                    <a href="/mypage/owner/goods_image_delete/{{ $image->id }}">
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
                        @foreach ($goods_folder->goods as $key=>$one_goods)
                            <div class="card mt-3 p-3 ex_data">
                                <input hidden name="goods_ids_{{$key+1}}" type="text" value="{{ $one_goods->id }}">
                                <div class="mb-3">
                                    <label class="form-label">商品種別</label>
                                    <input name="goods_names_{{$key+1}}" type="text" class="form-control" value="{{ $one_goods->name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">料金</label>
                                    <input name="goods_pricies_{{$key+1}}" type="number" class="form-control" value="{{ $one_goods->price }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">コメント</label>
                                    <textarea name="goods_descriptions_{{$key+1}}" type="text" class="form-control">{{ $one_goods->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ソートナンバー</label>
                                    <input name="goods_sort_nos_{{$key+1}}" type="number" class="form-control" value="{{ $one_goods->sort_no}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">個数</label>
                                    <input name="goods_quantities_{{$key+1}}" type="number" class="form-control" value="{{ $one_goods->quantity }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">体験の表示・非表示</label>
                                    @if( $one_goods->status == 1 )
                                        <input name="goods_statuses_{{$key+1}}" type="radio" checked value="1">
                                        <label>表示</label>
                                        <input name="goods_statuses_{{$key+1}}" type="radio" value="0">
                                        <label>非表示</label>
                                    @else
                                        <input name="goods_statuses_{{$key+1}}" type="radio" value="1">
                                        <label>表示</label>
                                        <input name="goods_statuses_{{$key+1}}" type="radio" checked value="0">
                                        <label>非表示</label>
                                    @endif
                                    
                                </div>
                                <a href="/mypage/owner/goods_delete/{{ $one_goods->id }}">
                                    <button type="button" class="mt-2 btn btn-danger" onclick="remove_ex({{ $loop->index }})">削除</button>
                                </a>
                            </div>
                        @endforeach
                        <div id="add_target"></div>
                        <input type="hidden" id="key" name="key" value="{{$key+1}}">
                        <button type="button" class="mt-2 btn btn-primary" onclick="add_ex({{ $goods_folder->goods->count() }})" >追加</button>
                    </div>
                </div>
                <button type="submit" class="mt-2 btn btn-primary">更新</button>
            </form>
        </div>
    </div>
</div>

@endsection
