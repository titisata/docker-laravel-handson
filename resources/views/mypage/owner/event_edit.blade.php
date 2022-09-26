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

    var c = '';

    function number_set(){

        // form要素を取得
        var element = document.getElementById( "target" ) ;

        // form要素内のラジオボタングループ(name="is_lodging")を取得
        var radioNodeList = element.is_lodging ;

        // 選択状態の値(value)を取得 (Bが選択状態なら"b"が返る)
        var a = radioNodeList.value ;

        if ( a == 0 ) {
            document.getElementById('hotel_result').value = 1;
            document.getElementById('food_result').value = 1;
            c = 1;

            let h_targets = document.querySelectorAll(`input[name='hotel_group[]']`);

            for (const i of h_targets) {
                i.checked = false;
            }

            let f_targets = document.querySelectorAll(`input[name='food_group[]']`);

            for (const n of f_targets) {
                n.checked = false;
            }
        }else{
            document.getElementById('hotel_result').value = 0;
            document.getElementById('food_result').value = 0;
            c = 0;
            let h_targets = document.querySelectorAll(`input[name='hotel_group[]']`);

            for (const i of h_targets) {
                i.checked = false;
            }

            let f_targets = document.querySelectorAll(`input[name='food_group[]']`);

            for (const n of f_targets) {
                n.checked = false;
            }
        }

        console.log(c);
    }
    

    function hotel_number_check(val){
        
        var item_count = document.getElementById('item_count').value;
        console.log(item_count);
        var result = 0;

        for(var i = 0; i < item_count; i++){
            var check = document.getElementsByName('hotel_group[]')[i];
            var set = ''; 
            if (check.checked) {
            result = 1;
            } 
        };
        
        document.getElementById('hotel_result').value = result;
      
       
    }

    function food_number_check(val){
        
        var item_count = document.getElementById('item_count').value;
        console.log(item_count);
        var result = 0;

        for(var i = 0; i < item_count; i++){
            var check = document.getElementsByName('food_group[]')[i];
            var set = ''; 
            if (check.checked) {
            result = 1 ;
            } 
        };
       
        document.getElementById('food_result').value = result;
        console.log(result);
       
    }

    
</script>
<div class="container">
    <h1>イベント編集</h1>
    @if(count($errors) > 0)
        <p class="text-danger">入力に問題があります。再入力してください</p>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form name="deleteform" action="/mypage/owner/event_edit_update" method="POST" onsubmit='return check();'>
                @csrf     
                <input type="hidden" name="delete_id" id="delete_path" value="">
            </form>
            <form action="/mypage/owner/event_edit_update" method="POST" id="target">
                @csrf
               
                <input type="hidden" id="hotel_result" name="hotel_result" value="1">
                <input type="hidden" id="food_result" name="food_result" value="1">
               
                <div class="card mt-3">
                    <div class="card-header">基本情報</div>
                    <div class="card-body">
                        <input name="id" type="hidden" class="form-control" value="{{ $experiences_folder->id }}">
                        <input name="user_id" type="hidden" class="form-control" value="{{ $experiences_folder->user_id }}">
                        <div class="mb-3">
                            <label class="form-label">名前</label>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="name" type="text" class="form-control" value="{{ $experiences_folder->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">大人料金</label>
                            @error('price_adult')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="price_adult" type="number" class="form-control" value="{{ $experiences_folder->price_adult }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">子供料金</label>
                            @error('price_child')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="price_child" type="number" class="form-control" value="{{ $experiences_folder->price_child }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">住所</label>
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="address" type="text" class="form-control">{{ $experiences_folder->address }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">説明</label>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="description" type="text" class="form-control">{{ $experiences_folder->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">イベント詳細</label>
                            @error('detail')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="detail" type="text" class="form-control">{{ $experiences_folder->detail }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">注意事項</label>
                            @error('caution')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
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
                            <label class="form-label">体験の表示</label>
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
                            <label class="form-label">おすすめフラグ</label>
                            @if( $experiences_folder->recommend_flag  == 1)
                                <input name="recommend_flag" type="radio" class="" checked value="1" >
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
                        <div class="mb-3">
                            <label class="form-label">宿泊の有無</label>
                            @if( $experiences_folder->is_lodging  == 1 )
                                <input name="is_lodging" type="radio" class="" checked value="1" onchange="number_set()">
                                <label>宿泊あり</label>
                                <input name="is_lodging" type="radio" class="" value="0" onchange="number_set()">
                                <label>宿泊なし</label>
                            @else
                                <input name="is_lodging" type="radio" class="" value="1" onchange="number_set()">
                                <label>宿泊あり</label>
                                <input name="is_lodging" type="radio" class="" checked value="0" onchange="number_set()">
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
                        
                        <div>
                            <label for="">
                                <div class="d-flex">
                                    <p>ホテルグループ選択</p>
                                    <p class="ms-3 text-danger">宿泊がない場合は表示されません</p>   
                                </div>
                                <?php $item_count=0; ?>
                                @error('hotel_result')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                @forelse($hotel_groups as $hotel_group)
                                <?php $item_count++; ?>
                                    @if(in_array($hotel_group->id, $checked_hotels_group, true))
                                        <div>
                                            <input type="checkbox" id="{{ $hotel_group->name }}" class="h_group" name="hotel_group[]" value="{{ $hotel_group->id }}" checked onchange="hotel_number_check(this.value)">
                                            <label for="{{ $hotel_group->name }}">{{ $hotel_group->name }}</label>
                                        </div> 
                                    @else
                                        <div>
                                            <input type="checkbox" id="{{ $hotel_group->name }}" class="h_group" name="hotel_group[]" value="{{ $hotel_group->id }}" onchange="hotel_number_check(this.value)">
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
                            <div class="d-flex">
                                    <p>フードグループ選択</p>
                                    <p class="ms-3 text-danger">宿泊がない場合は表示されません</p>
                                </div>
                                @error('food_result')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                @forelse($food_groups as $food_group)
                                   @if(in_array($food_group->id, $checked_foods_group, true))
                                        <div>
                                            <input type="checkbox" id="{{ $food_group->name }}" name="food_group[]" value="{{ $food_group->id }}" checked onchange="food_number_check(this.value)">
                                            <label for="{{ $food_group->name }}">{{ $food_group->name }}</label>
                                        </div> 
                                    @else
                                        <div>
                                            <input type="checkbox" id="{{ $food_group->name }}" name="food_group[]" value="{{ $food_group->id }}" onchange="food_number_check(this.value)">
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
                        
                        @forelse ($experiences_folder->experiences as $key=>$experience)
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
                                    <label class="form-label">体験の表示</label>
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
                        @empty

                            
                        
                        @endforelse
                        <div id="add_target"></div>
                        <input type="hidden" id="key" name="key" value="{{$key+1}}">
                       
                        <button type="button" class="mt-2 btn btn-primary" onclick="add_ex({{ $experiences_folder->experiences->count() }})">追加</button>
                    </div>
                </div>
                <input type="hidden" name="item_count" id="item_count" value="<?php echo $item_count; ?>">
                <button type="submit" class="mt-2 btn btn-primary submit">更新</button>
            </form>
        </div>
    </div>
</div>
@endsection
