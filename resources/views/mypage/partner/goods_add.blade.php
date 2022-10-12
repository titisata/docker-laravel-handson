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
    let key_count = 0;

    function add_ex() {
        let index = add_count;
        add_count++;
        key_count++; 
        console.log (index); 
        key = key_count;
        const element = document.querySelector('#add_target');
        const createElement = `
            <div class="card mt-3 p-3 ex_data" id="data_` + key + `">
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
                    <div class="d-flex">
                        <label class="form-label">表示の順番</label>
                        <p class="mb-1 ms-3">小さい数ほど優先して表示されます。</p>
                    </div>
                    <input name="goods_sort_nos_` + key + `" type="number" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">個数</label>
                    <input name="goods_quantities_` + key + `" type="number" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">お土産の表示</label>
                    <div>
                    <input name="goods_statuses_` + key + `" type="radio" checked value="1">
                    <label class="fw-normal">表示</label>
                    <input name="goods_statuses_` + key + `" type="radio" value="0">
                    <label class="fw-normal">非表示</label>
                    </div>
                </div>
                <button type="button" class="mt-2 btn btn-danger" onclick="remove_goods(${key})">削除</button>
            </div>
        `;

        document.getElementById('key_count').value = key_count;
        element.insertAdjacentHTML('beforeend', createElement);
    }
    
    function remove_goods(key) {
        var delete_id = 'data_' + key;
        const elements = document.getElementById(delete_id);
        elements.remove();
    }

</script>
<div class="container">
    <h1>お土産新規登録</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/mypage/partner/action_goods_add" method="POST" enctype="multipart/form-data">
                @csrf
                <input name="user_id" type="hidden" value="{{ $user->id }}" >
                <div class="card mt-3">
                    <div class="card-header">基本情報</div>
                    <div class="card-body">
                    <div class="mb-3">
                            <label class="form-label">商品名</label>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">標準商品価格</label>
                            @error('price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="price" type="number" class="form-control" value="{{ old('price') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">コメント</label>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="description" type="text" class="form-control" rows="5">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">注意事項</label>
                            @error('caution')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="caution" type="text" class="form-control" rows="5">{{ old('caution') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">詳細情報</label>
                            @error('detail')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="detail" type="text" class="form-control" rows="5">{{ old('detail') }}</textarea>
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
                            <label class="form-label">お土産の表示</label>
                            <div>
                                <input name="status" type="radio" class="" checked value="1">
                                <label class="fw-normal">表示</label>
                                <input name="status" type="radio" class="" value="0">
                                <label class="fw-normal">非表示</label>
                            </div>
                            
                        </div>
                        <div class="mb-3">
                            <label class="form-label">おすすめフラグ</label>
                            <div>
                                <input name="recommend_flag" type="radio" class="" checked value="1">
                                <label class="fw-normal">おすすめする</label>
                                <input name="recommend_flag" type="radio" class="" value="0">
                                <label class="fw-normal">おすすめしない</label>

                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex">
                                <label class="form-label">おすすめ表示の順番</label>
                                <p class="mb-1 ms-3">小さい数ほど優先して表示されます。</p>
                            </div>
                            <input name="recommend_sort_no" type="number" class="form-control" style="width:60px" value="{{ old('recommend_sort_no') }}">
                        </div>
                        <div class="mt-3">
                            <div>
                                <label>画像設定</label>
                                <input type="hidden" name="table_name" value="goods_folders" />
                                アップロード: <input name="image_path" type="file" />
                                </a>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">詳細設定</div>
                    <div class="card-body">
                        
                        <div class="card mt-3 p-3 ex_data">
                            <div class="mb-3">
                                
                                <label class="form-label">商品種別</label>
                                @error('goods_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input name="goods_name" type="text" class="form-control" value="{{ old('goods_name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">料金</label>
                                @error('goods_price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input name="goods_price" type="number" class="form-control" value="{{ old('goods_price') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">コメント</label>
                                @error('goods_description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <textarea name="goods_description" type="text" class="form-control" rows="5">{{ old('goods_description') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex">
                                    <label class="form-label">表示の順番</label>
                                    <p class="mb-1 ms-3">小さい数ほど優先して表示されます。</p>
                                </div>
                                @error('goods_sort_no')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input name="goods_sort_no" type="number" class="form-control" value="{{ old('goods_sort_no') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">個数</label>
                                @error('goods_quantity')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input name="goods_quantity" type="number" class="form-control" value="{{ old('goods_quantity') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">お土産の表示・非表示</label>
                                <div>
                                    <input name="goods_status" type="radio" checked value="1">
                                    <label class="fw-normal">表示</label>
                                    <input name="goods_status" type="radio" value="0">
                                    <label class="fw-normal">非表示</label>

                                </div>
                                
                               
                            </div>
                        </div>
                        
                        <div id="add_target"></div>
                        <input type="hidden" id="key_count" name="key_count" value="0">
                        <button type="button" class="mt-2 btn btn-primary" onclick="add_ex()">追加</button>
                    </div>
                </div>
                </div>
                <button type="submit" class="my-2 btn btn-primary">新規作成</button>
            </form>
        </div>
    </div>
</div>

@endsection
