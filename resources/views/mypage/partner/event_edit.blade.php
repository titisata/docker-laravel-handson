@extends('mypage.layouts.app')

@section('menu', 'partner_event')
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
                <div class="mb-3">
                    <label class="form-label">名前</label>
                    <input name="ex_name[]" type="text" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">大人料金</label>
                    <input name="ex_price_adult[]" type="number" class="form-control" value="{{ $experiences_folder->price_adult }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">子供料金</label>
                    <input name="ex_price_child[]" type="number" class="form-control" value="{{ $experiences_folder->price_child }}">
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
            <form action="{{ request()->fullUrl() }}" method="POST">
                @csrf
                <div class="card mt-3">
                    <div class="card-header">基本情報</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">名前</label>
                            <input name="name" type="text" class="form-control" value="{{ $experiences_folder->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">大人料金</label>
                            <input name="price_adult" type="number" class="form-control" value="{{ $experiences_folder->price_adult }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">子供料金</label>
                            <input name="price_child" type="number" class="form-control" value="{{ $experiences_folder->price_child }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">説明</label>
                            <textarea name="description" type="text" class="form-control">{{ $experiences_folder->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">注意事項</label>
                            <textarea name="caution" type="text" class="form-control">{{ $experiences_folder->caution }}</textarea>
                        </div>
                        <div class="mb-3">
                        <label class="form-label">カテゴリ</label>
                        <select name="category" class="form-select mt-2" style="width:216px">
                            @foreach ($categories as $category)
                                <option @if ($experiences_folder->category == $category->name) selected @endif value="{{ $category->name }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="mt-3">
                            <div>
                                <label>画像設定</label>
                                <a href="/mypage/partner/event_image_insert/{{ $experiences_folder->id }}">
                                    <div class="btn btn-success">
                                        新規登録     
                                    </div>
                                </a>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between">
                            @foreach($experiences_folder->images() as $image)
                            <div class="d-flex flex-column col-4 my-3">
                                <img class="card-img" style="width: 200px;height: 140px; object-fit: cover;" src="/{{ $image->image_path }}" alt=""> 
                                <div class="d-flex">
                                    <a href="/mypage/partner/event_image_update/{{ $image->id }}">
                                        <div class="btn btn-primary">編集</div>
                                    </a>    
                                    <a href="/mypage/partner/event_image_delete/{{ $image->id }}">
                                        <div class="btn btn-danger">削除</div>
                                    </a>                             
                                </div>                         
                                
                            </div>                          
                                
                            @endforeach
                        </div>
                        </div>
                        
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">時間帯設定</div>
                    <div class="card-body">
                        @foreach ($experiences_folder->experiences as $experience)
                            <div class="card mt-3 p-3 ex_data">
                                <input hidden name="ex_ids[]" type="text" value="{{ $experience->id }}">
                                <div class="mb-3">
                                    <label class="form-label">名前</label>
                                    <input name="ex_names[]" type="text" class="form-control" value="{{ $experience->name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">大人料金</label>
                                    <input name="ex_price_adults[]" type="number" class="form-control" value="{{ $experience->price_adult }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">子供料金</label>
                                    <input name="ex_price_childs[]" type="number" class="form-control" value="{{ $experience->price_child }}">
                                </div>
                                <button type="button" class="mt-2 btn btn-danger" onclick="remove_ex({{ $loop->index }})">削除</button>
                            </div>
                        @endforeach
                        <div id="add_target"></div>
                        <button type="button" class="mt-2 btn btn-primary" onclick="add_ex({{ $experiences_folder->experiences->count() }})">追加</button>
                    </div>
                </div>
                <button type="submit" class="mt-2 btn btn-primary">更新</button>
            </form>
        </div>
    </div>
</div>
@endsection
