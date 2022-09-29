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
                    <label class="form-label">体験の時間帯</label>
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
                    <div class="d-flex">
                        <label class="form-label">表示の順番</label>
                        <p class="mb-1 ms-3">小さい数ほど優先して表示されます。</p>
                    </div>
                    <input name="ex_sort_nos_` + key + `" type="number" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">上限人数</label>
                    <input name="ex_quantities_` + key + `" type="number" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <div>
                        <label class="form-label">体験の表示・非表示</label>
                        <input name="ex_statuses_` + key + `" type="radio" class="" checked value="1">
                        <label>表示</label>
                        <input name="ex_statuses_` + key + `" type="radio" class="" value="0">
                        <label>非表示</label>  
                    </div>         
                </div>
                <button type="button" class="mt-2 btn btn-danger" onclick="remove_ex(${key})">削除</button>
            </div>
        `;
        
        
        element.insertAdjacentHTML('beforeend', createElement);
    }
    
    function remove_ex(key) {
        var delete_id = 'data_' + key;
        const elements = document.getElementById(delete_id);
        elements.remove();
    }

    function delete_btn(key) {
        var delete_num = 'delete_btn_' + key;

        var set = document.getElementById(delete_num).value;
        console.log(set);
        
        document.getElementById('delete_path').value = set;

        console.log(document.getElementById('delete_path').value);

        // delete_path.remove();
        
        //submit()でフォームの内容を送信
        document.deleteform.submit();
    }
    // let count = 0; 
    // let btn = document.getElementById('delete_btn');
    // console.log(btn);

    // btn.addEventListener('click', function() {
    //   alert(document.deleteform.delete_id.value);


    //   document.getElementById('delete_path').value = btn.value;

    //   console.log(document.getElementById('delete_path').value);

  
    //   //submit()でフォームの内容を送信
    //   document.deleteform.submit();
    // })

    // let count = 0; 
    // let btn = document.getElementById('delete_btn');
    // console.log(btn);

    // btn.addEventListener('click', function() {
    //   alert(document.deleteform.delete_id.value);


    //   document.getElementById('delete_path').value = btn.value;

    //   console.log(document.getElementById('delete_path').value);

  
    //   //submit()でフォームの内容を送信
    //   document.deleteform.submit();
    // })
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
            <form name="deleteform" action="/mypage/partner/event_edit_delete" method="POST" onsubmit='return check();'>
                @csrf     
                <input type="hidden" name="delete_id" id="delete_path" value="">
                <input type="hidden" name="id" value="{{ $experiences_folder->id }}">
            </form>
            <form action="/mypage/partner/event_edit_update" method="POST" id="target">
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
                        <label class="form-label">連絡先電話番号<span class="small text-danger ms-3">この体験に関する電話連絡（キャンセルやお問合せ等）の受付先を入力してください</span></label>
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="phone" type="text" class="form-control" rows="3">{{ $experiences_folder->phone }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">体験説明</label>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="description" type="text" class="form-control" rows="5">{{ $experiences_folder->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">イベント詳細</label>
                            @error('detail')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="detail" type="text" class="form-control" rows="5">{{ $experiences_folder->detail }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">注意事項</label>
                            @error('caution')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="caution" type="text" class="form-control" rows="5">{{ $experiences_folder->caution }}</textarea>
                        </div>
                        <div class="mb-3">
                        <div class="d-flex">
                            <label class="form-label">カテゴリ選択</label>
                            <p class="ms-3">当てはまるカテゴリーを選択してください。</p>
                        </div>
                        
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
                                <div>
                                    <input name="status" type="radio" class="" checked value="1">
                                    <label class="fw-normal">表示</label>
                                    <input name="status" type="radio" class="" value="0">
                                    <label class="fw-normal">非表示</label>
                                </div>
                            @else
                                <div>
                                    <input name="status" type="radio" class="" value="1">
                                    <label class="fw-normal">表示</label>
                                    <input name="status" type="radio" class="" checked value="0">
                                    <label class="fw-normal">非表示</label>
                                </div>
                            @endif
                            
                        </div>
                        <div class="mb-3">
                            <label class="form-label">おすすめフラグ</label>
                            @if( $experiences_folder->recommend_flag  == 1)
                                <div>
                                    <input name="recommend_flag" type="radio" class="" checked value="1" >
                                    <label class="fw-normal">おすすめする</label>
                                    <input name="recommend_flag" type="radio" class="" value="0">
                                    <label class="fw-normal">おすすめしない</label>

                                </div>
                                
                            @else
                                <div>
                                    <input name="recommend_flag" type="radio" class="" value="1">
                                    <label class="fw-normal">おすすめする</label>
                                    <input name="recommend_flag" type="radio" class="" checked value="0">
                                    <label class="fw-normal">おすすめしない</label>

                                </div>
                                
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">宿泊の有無</label>
                            @if( $experiences_folder->is_lodging  == 1 )
                                <div>
                                    <input name="is_lodging" type="radio" class="" checked value="1" onchange="number_set()">
                                    <label class="fw-normal">宿泊あり</label>
                                    <input name="is_lodging" type="radio" class="" value="0" onchange="number_set()">
                                    <label class="fw-normal">宿泊なし</label>

                                </div>
                                
                            @else
                                <div>
                                    <input name="is_lodging" type="radio" class="" value="1" onchange="number_set()">
                                    <label class="fw-normal">宿泊あり</label>
                                    <input name="is_lodging" type="radio" class="" checked value="0" onchange="number_set()">
                                    <label class="fw-normal">宿泊なし</label>
                                </div>
                                
                            @endif
                            
                        </div>
                        <div class="mb-3">
                            <label class="form-label">宿泊の場合の前泊・後泊</label>
                            @if( $experiences_folder->is_before_lodging  == 0 )
                                <div >
                                    <input name="is_before_lodging" type="radio" class="" checked value="0">
                                    <label class="fw-normal">後泊</label>
                                    <input name="is_before_lodging" type="radio" class="" value="1">
                                    <label class="fw-normal">前泊</label>

                                </div>
                                
                            @else
                                <div >
                                    <input name="is_before_lodging" type="radio" class="" value="0">
                                    <label class="fw-normal">後泊</label>
                                    <input name="is_before_lodging" type="radio" class="" checked value="1">
                                    <label class="fw-normal">前泊</label>

                                </div>
                               
                            @endif
                        </div>
                        
                        <div class="mb-4">
                            <p class="fw-bold mb-1">ホテルグループ選択</p>
                            <p class="ms-3 mb-0">宿泊体験の場合のホテルグループを下記の中から選択してください</p>
                            <p class="ms-3 text-danger">宿泊がない場合は表示されません</p> 
                            <?php $item_count=0; ?>
                            @error('hotel_result')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            @forelse($hotel_groups as $hotel_group)
                            <?php $item_count++; ?>
                                @if(in_array($hotel_group->id, $checked_hotels_group, true))
                                    <div class="d-flex align-items-center mb-2 ms-3">
                                        <input type="checkbox" id="{{ $hotel_group->name }}" class="h_group mt-0" name="hotel_group[]" value="{{ $hotel_group->id }}" checked onchange="hotel_number_check(this.value)">
                                        <label class="mb-0 " for="{{ $hotel_group->name }}">{{ $hotel_group->name }}</label>
                                        <p class="mb-0 ms-3">大人料金：{{ $hotel_group->price_adult }}円</p>
                                        <p class="mb-0 ms-3">子供料金：{{ $hotel_group->price_child }}円</p>
                                    </div> 
                                @else
                                    <div class="d-flex align-items-center mb-2 ms-3">
                                        <input type="checkbox" id="{{ $hotel_group->name }}" class="h_group mt-0" name="hotel_group[]" value="{{ $hotel_group->id }}" onchange="hotel_number_check(this.value)">
                                        <label class="mb-0" for="{{ $hotel_group->name }}">{{ $hotel_group->name }}</label>
                                        <p class="mb-0 ms-3">大人料金：{{ $hotel_group->price_adult }}円</p>
                                        <p class="mb-0 ms-3">子供料金：{{ $hotel_group->price_child }}円</p>
                                    </div> 
                                @endif
                                
                            @empty
                                <p>グループがありません</p>
                            @endforelse
                            </select>
        
                        </div>
                        <div class="mb-4">
                            <p class="fw-bold mb-1">フードグループ選択</p>
                            <p class="ms-3 mb-0">宿泊体験の場合のフードグループを下記の中から選択してください</p>
                            <p class="ms-3 text-danger">宿泊がない場合は表示されません</p>
                            @error('food_result')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            @forelse($food_groups as $food_group)
                                @if(in_array($food_group->id, $checked_foods_group, true))
                                    <div class="d-flex align-items-center mb-2 ms-3">
                                        <input type="checkbox" id="{{ $food_group->name }}" class="mt-0" name="food_group[]" value="{{ $food_group->id }}" checked onchange="food_number_check(this.value)">
                                        <label class="mb-0" for="{{ $food_group->name }}">{{ $food_group->name }}</label>
                                        <p class="mb-0 ms-3">大人料金：{{ $food_group->price_adult }}円</p>
                                        <p class="mb-0 ms-3">子供料金：{{ $food_group->price_child }}円</p>
                                    </div> 
                                @else
                                    <div class="d-flex align-items-center mb-2 ms-3">
                                        <input type="checkbox" id="{{ $food_group->name }}" class="mt-0" name="food_group[]" value="{{ $food_group->id }}" onchange="food_number_check(this.value)">
                                        <label class="mb-0" for="{{ $food_group->name }}">{{ $food_group->name }}</label>
                                        <p class="mb-0 ms-3">大人料金：{{ $food_group->price_adult }}円</p>
                                        <p class="mb-0 ms-3">子供料金：{{ $food_group->price_child }}円</p>
                                    </div> 
                                @endif
                            @empty
                                <p>グループがありません</p>
                            @endforelse
                            </select>
                            
                        </div>
                        <div class="mt-3">
                            <div>
                                <label>画像設定</label>
                                <a href="/mypage/partner/event_image_insert/{{ $experiences_folder->id }}">
                                    <div class="btn btn-success">
                                        画像登録     
                                    </div>
                                </a>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between">
                            @foreach($experiences_folder->images() as $image)
                            <div class="d-flex flex-column col-4 my-3">
                                <img class="card-img" style="width: 200px;height: 140px; object-fit: cover;" src="{{ $image->image_path }}" alt=""> 
                                <div class="d-flex">
                                    <a href="/mypage/partner/event_image_update/{{ $image->id }}">
                                        <div class="btn btn-primary">画像更新</div>
                                    </a>    
                                    <a href="/mypage/partner/event_image_delete/{{ $image->id }}">
                                        <div class="btn btn-danger">画像削除</div>
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
                                    <label class="form-label">体験の時間帯</label>
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
                                    <div class="d-flex">
                                        <label class="form-label">表示の順番</label>
                                        <p class="mb-1 ms-3">小さい数ほど優先して表示されます。</p>
                                    </div>
                                    <input name="ex_sort_nos_{{$key+1}}" type="number" class="form-control" value="{{ $experience->sort_no}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">上限人数</label>
                                    <input name="ex_quantities_{{$key+1}}" type="number" class="form-control" value="{{ $experience->quantity }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">体験の表示</label>
                                    @if( $experience->status == 1 )
                                        <div>
                                            <input name="ex_statuses_{{$key+1}}" type="radio" checked value="1">
                                            <label class="fw-normal">表示</label>
                                            <input name="ex_statuses_{{$key+1}}" type="radio" value="0">
                                            <label class="fw-normal">非表示</label>
                                        </div>
                                        
                                    @else
                                        <div>
                                            <input name="ex_statuses_{{$key+1}}" type="radio" value="1">
                                            <label class="fw-normal">表示</label>
                                            <input name="ex_statuses_{{$key+1}}" type="radio" checked value="0">
                                            <label class="fw-normal">非表示</label>

                                        </div>
                                        
                                    @endif
                                    
                                </div>
                                
                                <button type="button" class="mt-2 btn btn-danger" id="delete_btn_{{ $key+1 }}" value="{{ $experience->id }}" onclick="delete_btn({{$key+1}})">削除</button>
                                
                            </div>
                        @empty

                            
                        
                        @endforelse
                        <div id="add_target"></div>
                        <input type="hidden" id="key" name="key" value="{{$key+1}}">
                       
                        <button type="button" class="mt-2 btn btn-primary" onclick="add_ex({{ $experiences_folder->experiences->count() }})">体験時間帯追加</button>
                    </div>
                </div>
                <input type="hidden" name="item_count" id="item_count" value="<?php echo $item_count; ?>">
                <button type="submit" class="mt-4 btn btn-primary submit">イベント更新</button>
            </form>
            
            <form class="my-4" action="/mypage/partner/action_event_delete" method="POST">
                @csrf
                <button class="btn btn-danger">イベント削除</button>
                <input type="hidden" name="id" value="{{ $experiences_folder->id }}">
            </form>
            
            
        </div>
    </div>
</div>
@endsection
