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
        let key_count = 0;
        let index = init_index + add_count;
        add_count++;
        key_count++;
        console.log (index);
        let key = parseInt(document.getElementById('key').value); 
        key = key + key_count;
        const element = document.querySelector('#add_target');
        const createElement = `
            <div class="card mt-3 p-3 ex_data" id="data_` + key + `" >
            <input hidden name="ex_ids" type="text" value="">
                <div class="mb-3">
                    <label class="form-label">名前</label>
                    <input name="ex_names_` + key + `" type="text" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">大人料金</label>
                    <input name="ex_price_adults_` + key + `" type="number" class="form-control" value="{{ $experiences_folder->price_adult }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">子供料金</label>
                    <input name="ex_price_childs_` + key + `" type="number" class="form-control" value="{{ $experiences_folder->price_child }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">ソートナンバー</label>
                    <input name="ex_sort_nos_` + key + `" type="number" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">上限人数</label>
                    <input name="ex_quantities_` + key + `" type="number" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">体験の表示・非表示</label>
                    <input name="ex_statuses_` + key + `" type="radio" class="" checked value="1">
                    <label>表示</label>
                    <input name="ex_statuses_` + key + `" type="radio" class="" value="0">
                    <label>非表示</label>       
                </div>
                <button type="button" class="mt-2 btn btn-danger" onclick="remove_ex(${key})">削除</button>
            </div>
        `;
        
        document.getElementById('key').value = key;
        element.insertAdjacentHTML('beforeend', createElement);
    }
    
    function remove_ex(key) {
        var delete_id = 'data_' + key;
        const elements = document.getElementById(delete_id);
        elements.remove();
    }

    let count = 0; 
    let btn = document.getElementById('delete_btn');
    console.log(btn);

    btn.addEventListener('click', function() {
      alert(document.deleteform.delete_id.value);


      document.getElementById('delete_path').value = btn.value;

      console.log(document.getElementById('delete_path').value);

  
      //submit()でフォームの内容を送信
      document.deleteform.submit();
    })
</script>
<div class="container">
    <h1>イベント編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form name="deleteform" action="/mypage/owner/event_edit_update" method="POST">
                @csrf     
                <input type="hidden" name="delete_id" id="delete_path" value="">
            </form>
            <form action="/mypage/owner/event_edit_update" method="POST">
                @csrf
                <div class="card mt-3">
                    <div class="card-header">基本情報</div>
                    <div class="card-body">
                        <input name="id" type="hidden" class="form-control" value="{{ $experiences_folder->id }}">
                        <input name="partner_id" type="hidden" class="form-control" value="{{ $experiences_folder->partner_id }}">
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
                            <label class="form-label">住所</label>
                            <textarea name="address" type="text" class="form-control">{{ $experiences_folder->address }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">説明</label>
                            <textarea name="description" type="text" class="form-control">{{ $experiences_folder->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">イベント詳細</label>
                            <textarea name="detail" type="text" class="form-control">{{ $experiences_folder->detail }}</textarea>
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
                        </div>
                        <div class="mb-3">
                            <label class="form-label">体験の表示・非表示</label>
                            @if( $experiences_folder->status  == 1 )
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
                            <label class="form-label">宿泊の有無</label>
                            @if( $experiences_folder->is_lodging  == 1 )
                                <input name="is_lodging" type="radio" class="" checked value="1">
                                <label>宿泊あり</label>
                                <input name="is_lodging" type="radio" class="" value="0">
                                <label>宿泊なし</label>
                            @else
                                <input name="is_lodging" type="radio" class="" value="1">
                                <label>宿泊あり</label>
                                <input name="is_lodging" type="radio" class="" checked value="0">
                                <label>宿泊なし</label>
                            @endif
                            
                        </div>
                        <div class="mb-3">
                            <label class="form-label">宿泊の場合の前泊・後泊</label>
                            @if( $experiences_folder->is_before_lodging  == 0 )
                                <input name="is_before_lodging" type="radio" class="" checked value="0">
                                <label>後泊</label>
                                <input name="is_before_lodging" type="radio" class="" value="1">
                                <label>前泊</label>
                            @else
                                <input name="is_before_lodging" type="radio" class="" value="0">
                                <label>後泊</label>
                                <input name="is_before_lodging" type="radio" class="" checked value="1">
                                <label>前泊</label>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">おすすめフラグ</label>
                            @if( $experiences_folder->recommend_flag  == 1)
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
                        <div>
                            <label for="">
                                ホテルグループ選択
                                @forelse($hotel_groups as $hotel_group)
                                    @if(in_array($hotel_group->id, $checked_hotels_group, true))
                                        <div>
                                            <input type="checkbox" id="{{ $hotel_group->name }}" name="hotel_group[]" value="{{ $hotel_group->id }}" checked >
                                            <label for="{{ $hotel_group->name }}">{{ $hotel_group->name }}</label>
                                        </div> 
                                    @else
                                        <div>
                                            <input type="checkbox" id="{{ $hotel_group->name }}" name="hotel_group[]" value="{{ $hotel_group->id }}">
                                            <label for="{{ $hotel_group->name }}">{{ $hotel_group->name }}</label>
                                        </div> 
                                    @endif
                                    
                                @empty
                                    <p>グループがありません</p>
                                @endforelse
                                </select>
                            </label>
                        </div>
                        <div>
                            <label for="">
                                フードグループ選択
                                @forelse($food_groups as $food_group)
                                   @if(in_array($food_group->id, $checked_foods_group, true))
                            <div>
                                <input type="checkbox" id="{{ $food_group->name }}" name="food_group[]" value="{{ $food_group->id }}" checked >
                                <label for="{{ $food_group->name }}">{{ $food_group->name }}</label>
                            </div> 
                        @else
                            <div>
                                <input type="checkbox" id="{{ $food_group->name }}" name="food_group[]" value="{{ $food_group->id }}">
                                <label for="{{ $food_group->name }}">{{ $food_group->name }}</label>
                            </div> 
                        @endif
                                @empty
                                    <p>グループがありません</p>
                                @endforelse
                                </select>
                            </label>
                        </div>
                        <div class="mt-3">
                            <div>
                                <label>画像設定</label>
                                <a href="/mypage/owner/event_image_insert/{{ $experiences_folder->id }}">
                                    <div class="btn btn-success">
                                        新規登録     
                                    </div>
                                </a>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between">
                            @foreach($experiences_folder->images() as $image)
                            <div class="d-flex flex-column col-4 my-3">
                                <img class="card-img" style="width: 200px;height: 140px; object-fit: cover;" src="{{ $image->image_path }}" alt=""> 
                                <div class="d-flex">
                                    <a href="/mypage/owner/event_image_update/{{ $image->id }}">
                                        <div class="btn btn-primary">編集</div>
                                    </a>    
                                    <a href="/mypage/owner/event_image_delete/{{ $image->id }}">
                                        <div class="btn btn-danger">削除</div>
                                    </a>                             
                                </div>                         
                                
                            </div>                          
                                
                            @endforeach
                        </div>
                        </div>
                        
                        </div>
                    </div>
                

                <div class="card mt-3">
                    <div class="card-header">時間帯設定</div>
                    <div class="card-body">
                        
                        @foreach ($experiences_folder->experiences as $key=>$experience)
                            <div class="card mt-3 p-3 ex_data">
                                <input hidden name="ex_ids_{{$key+1}}" type="text" value="{{ $experience->id }}">
                                <div class="mb-3">
                                    <label class="form-label">名前</label>
                                    <input name="ex_names_{{$key+1}}" type="text" class="form-control" value="{{ $experience->name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">大人料金</label>
                                    <input name="ex_price_adults_{{$key+1}}" type="number" class="form-control" value="{{ $experience->price_adult }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">子供料金</label>
                                    <input name="ex_price_childs_{{$key+1}}" type="number" class="form-control" value="{{ $experience->price_child }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ソートナンバー</label>
                                    <input name="ex_sort_nos_{{$key+1}}" type="number" class="form-control" value="{{ $experience->sort_no}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">上限人数</label>
                                    <input name="ex_quantities_{{$key+1}}" type="number" class="form-control" value="{{ $experience->quantity }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">体験の表示・非表示</label>
                                    @if( $experience->status == 1 )
                                        <input name="ex_statuses_{{$key+1}}" type="radio" checked value="1">
                                        <label>表示</label>
                                        <input name="ex_statuses_{{$key+1}}" type="radio" value="0">
                                        <label>非表示</label>
                                    @else
                                        <input name="ex_statuses_{{$key+1}}" type="radio" value="1">
                                        <label>表示</label>
                                        <input name="ex_statuses_{{$key+1}}" type="radio" checked value="0">
                                        <label>非表示</label>
                                    @endif
                                    
                                </div>
                                
                                <button type="button" class="mt-2 btn btn-danger" id="delete_btn_{{ $experience->id }}" value="{{ $experience->id }}">削除</button>
                                
                                
                            </div>
                        @endforeach
                        <div id="add_target"></div>
                        <input type="hidden" id="key" name="key" value="{{$key+1}}">   
                        <button type="button" class="mt-2 btn btn-primary" onclick="add_ex({{ $experiences_folder->experiences->count() }})">追加</button>
                    </div>
                </div>
                <button type="submit" class="mt-2 btn btn-primary">更新</button>
            </form>
        </div>
    </div>
</div>
@endsection
