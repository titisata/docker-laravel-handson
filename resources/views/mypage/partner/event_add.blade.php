@extends('mypage.layouts.app')

@section('menu', 'partner_event')
@section('content')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

<script>
    window.onload = function(){
        // 日本語化
        $.datepicker.regional['ja'] = {
        closeText: '閉じる',
        prevText: '<前',
        nextText: '次>',
        currentText: '今日',
        monthNames: ['1月','2月','3月','4月','5月','6月',
        '7月','8月','9月','10月','11月','12月'],
        monthNamesShort: ['1月','2月','3月','4月','5月','6月',
        '7月','8月','9月','10月','11月','12月'],
        dayNames: ['日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日'],
        dayNamesShort: ['日','月','火','水','木','金','土'],
        dayNamesMin: ['日','月','火','水','木','金','土'],
        weekHeader: '週',
        dateFormat: 'yy/mm/dd',
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: true,
        minViewMode: 2,
        yearSuffix: '年'};
        $.datepicker.setDefaults($.datepicker.regional['ja']);
    }

    $(function() {
        $('#select_date').datepicker();
    });

    function add_date(){
        var cnt = document.getElementById('schedule_counter').value;
        var val = document.getElementById('select_date').value;
        if(val == ""){
            alert('日付を選択してください');
            return;
        }

        cnt = Number(cnt) + 1;
        var div_element = document.createElement('div');
        div_element.id = 'div_schedule_' + cnt;
        div_element.className = 'd-flex mt-1';
        div_element.innerHTML = '<input class="form-control" style="width:200px;" type="text" name="selected_date[]" value="' + val + '" readonly>';
		div_element.innerHTML+= '<input class="btn btn-primary" style="width:40px;" type="button" value="-" onclick="delete_date(' + cnt + ');">';
        var parent_object = document.getElementById('div_selected_date');
		parent_object.appendChild(div_element);

        document.getElementById('schedule_counter').value = cnt;
        document.getElementById('select_date').value = "";
    }

    function delete_date(id){
        var dom_obj = document.getElementById('div_schedule_' + id);
		var dom_obj_parent = dom_obj.parentNode;
		dom_obj_parent.removeChild(dom_obj);
    }
</script>
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
            <div class="card mt-3 p-3 ex_data" id="data_` + key + `" >
                <div class="mb-3">
                    <label class="form-label">体験の時間帯</label>
                    <input name="ex_names_` + key + `" type="text" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">大人料金</label>
                    <input name="ex_price_adults_` + key + `" type="number" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">子供料金</label>
                    <input name="ex_price_childs_` + key + `" type="number" class="form-control" value="">
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
                    <label class="form-label">体験の表示</label>
                    <div>
                    <input name="ex_statuses_` + key + `" type="radio" class="" checked value="1">
                    <label>表示</label>
                    <input name="ex_statuses_` + key + `" type="radio" class="" value="0">
                    <label>非表示</label> 
                    </div>      
                </div>
                <button type="button" class="mt-2 btn btn-danger" onclick="remove_ex(${key})">削除</button>
            </div>
        `;
        
        document.getElementById('key_count').value = key_count;
        element.insertAdjacentHTML('beforeend', createElement);
    }
    
    function remove_ex(key) {
        var delete_id = 'data_' + key;
        const elements = document.getElementById(delete_id);
        elements.remove();
    }
    
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
    <h1>イベント新規作成</h1>
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
        <form action="/mypage/partner/action_event_add" method="POST" enctype="multipart/form-data" id="target">
                @csrf
                <div class="card">
                <input type="hidden" id="hotel_result" name="hotel_result" value="0">
                <input type="hidden" id="food_result" name="food_result" value="0">
                <input name="user_id" type="hidden" value="{{ $user->id }}">
                    <div class="card-header">基本情報</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">名前</label>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="name" type="text" class="form-control" value="{{ old('name') }}" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">大人料金目安<span class="small fw-normal">（実際の料金ではなく、表示の際に必要な目安です）</span></label>
                            @error('price_adult')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="price_adult" type="number" class="form-control"  value="{{ old('price_adult') }}" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">子供料金目安<span class="small fw-normal">（実際の料金ではなく、表示の際に必要な目安です）</span></label>
                            @error('price_child')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="price_child" type="number" class="form-control"  value="{{ old('price_child') }}" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">住所</label>
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="address" type="text" class="form-control"  value="{{ old('address') }}" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">お問合せ先情報<span class="small text-danger ms-2">この体験に関する電話連絡（キャンセルやお問合せ等）の受付先を入力してください</span></label>
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="phone" type="text" class="form-control" rows="3">キャンセルに関するお問合せ（oo観光協会）：00-0000-0000体験に関するお問合せ（株式会社　サンプル）：00-0000-0000

                            </textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">体験説明</label>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="description" type="text" class="form-control" rows="5"> {{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">イベント詳細</label>
                            @error('detail')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="detail" type="text" class="form-control" rows="5" >{{ old('detail') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">注意事項</label>
                            @error('caution')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="caution" type="text" class="form-control" rows="5">{{ old('caution') }}</textarea>
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
                                <input name="recommend_flag" type="radio" class="" checked  value="1">
                                <label class="fw-normal">おすすめする</label>
                                <input name="recommend_flag" type="radio" class="" value="0">
                                <label class="fw-normal">おすすめしない</label>
                            </div>
                            
                        </div>
                        <div class="mb-3">
                            <label class="form-label">宿泊の有無</label>
                            <div>
                                <input name="is_lodging" type="radio" class="" checked  value="1" onchange="number_set()">
                                <label class="fw-normal">宿泊あり</label>
                                <input name="is_lodging" type="radio" class="" value="0" onchange="number_set()">
                                <label class="fw-normal">宿泊なし</label>
                            </div> 
                        </div>
                        <div class="mb-3">
                            <label class="form-label">宿泊の場合の前泊・後泊</label>
                            <div>
                                <input name="is_before_lodging" type="radio" class="" checked  value="0">
                                <label class="fw-normal">後泊</label>
                                <input name="is_before_lodging" type="radio" class="" value="1">
                                <label class="fw-normal">前泊</label>
                            </div>
                        </div>
                        <div>
                            <p class="fw-bold mb-1">ホテルグループ選択</p>
                            <p class="ms-3 mb-0">宿泊体験の場合のホテルグループを下記の中から選択してください</p>
                            <p class="ms-3 text-danger">宿泊がない場合は表示されません</p>      
                            <?php $item_count=0; ?>         
                            @error('hotel_result')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            @forelse($hotel_groups as $hotel_group)
                            <?php $item_count++; ?>
                                <div class="d-flex align-items-center mb-2">
                                    <input type="checkbox" id="{{ $hotel_group->name }}" class="h_group mt-0" name="hotel_group[]" value="{{ $hotel_group->id }}" onchange="hotel_number_check(this.value)">
                                    <label class="mb-0" for="{{ $hotel_group->name }}">{{ $hotel_group->name }}</label>
                                    <p class="mb-0 ms-3">大人料金：{{ $hotel_group->price_adult }}円</p>
                                    <p class="mb-0 ms-3">子供料金：{{ $hotel_group->price_child }}円</p>
                                </div> 
                            @empty
                                <p>グループがありません</p>
                            @endforelse
                            </select>
                        </div>
                        <div class="mt-4">
                            <p class="fw-bold mb-1">フードグループ選択</p>
                            <p class="ms-3 mb-0">宿泊体験の場合のフードグループを下記の中から選択してください</p>
                            <p class="ms-3 text-danger">宿泊がない場合は表示されません</p>
                            @error('food_result')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            @forelse($food_groups as $food_group)
                                <div class="d-flex align-items-center mb-2">
                                    <input type="checkbox" id="{{ $food_group->name }}" class="mt-0" name="food_group[]" value="{{ $food_group->id }}" onchange="food_number_check(this.value)">
                                    <label class="mb-0" for="{{ $food_group->name }}">{{ $food_group->name }}</label>
                                    <p class="mb-0 ms-3">大人料金：{{ $food_group->price_adult }}円</p>
                                    <p class="mb-0 ms-3">子供料金：{{ $food_group->price_child }}円</p>
                                </div> 
                            @empty
                                <p>グループがありません</p>
                            @endforelse
                            </select>
                        </div>
                        <div class="mt-4">
                            <div>
                                <label>画像設定</label>
                                <input type="hidden" name="table_name" value="experience_folders" />
                                <input  name="image_path" type="file" />
                            </div>
                        </div>  
                    </div> 
                </div> 

                        <div class="card mt-3">
                        <div class="card-header">イベント期間</div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <label for="">
                                    イベント開始日
                                    @error('start_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input class="form-control" style="width:200px;" type='date' name="start_date" value="{{ old('start_date') }}">
                                </label>
                                <p class="fs-1 mx-3">~</p>
                                <label for="">
                                    イベント終了日
                                    @error('end_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input class="form-control" style="width:200px;" type='date' name="end_date" value="{{ old('end_date') }}">
                                </label>
                                
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">休暇設定</div>
                        <div class="card-body">
                            <div class="d-flex">
                                <input class="form-control" style="width:200px;" type='text' id='select_date' name='selecte_date' value=''>
                                <input class="btn btn-primary" style="width:40px;" type="button" value="+" onclick="add_date();">
                            </div>
                            <?php $schedule_count=0; ?>
                            <div id="div_selected_date"> 
                                
                                <input type="hidden" id="schedule_counter" value="<?php echo $schedule_count; ?>">
                            </div>
                        </div>
                    </div>
                        
                    

                    <div class="card mt-3">
                        <div class="card-header">時間帯設定</div>
                        <div class="card-body">
                            
                            <div class="card mt-3 p-3 ex_data">
                                
                                <div class="mb-3">
                                    <label class="form-label">体験の時間帯</label>
                                    @error('ex_name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input name="ex_name" type="text" class="form-control" value="{{ old('ex_name') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">大人料金<span class="small fw-normal">(時間帯別の料金)</span></label>
                                    @error('ex_price_adult')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input name="ex_price_adult" type="number" class="form-control" value="{{ old('ex_price_adult') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">子供料金<span class="small fw-normal">(時間帯別の料金)</span></label>
                                    @error('ex_price_child')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input name="ex_price_child" type="number" class="form-control" value="{{ old('ex_price_child') }}">
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex">
                                        <label class="form-label">表示の順番</label>
                                        <p class="mb-1 ms-3">小さい数ほど優先して表示されます。</p>
                                    </div>
                                    @error('ex_sort_no')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input name="ex_sort_no" type="number" class="form-control" value="{{ old('ex_sort_no') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">上限人数</label>
                                    @error('ex_quantity')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input name="ex_quantity" type="number" class="form-control" value="{{ old('ex_quantity') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">体験の表示</label>
                                    <div>
                                        <input name="ex_status" type="radio" checked value="1">
                                        <label class="fw-normal">表示</label>
                                        <input name="ex_status" type="radio" value="0">
                                        <label class="fw-normal">非表示</label>

                                    </div>
                                </div>
                        
                            </div>
                            <div id="add_target"></div>
                            <input type="hidden" id="key_count" name="key_count" value="0">
                            <input type="hidden" name="item_count" id="item_count" value="<?php echo $item_count; ?>">
                            <button type="button" class="mt-2 btn btn-primary" onclick="add_ex()">体験の時間帯追加</button>
                            
                        </div>
               
                    </div>
                
                <button type="submit" class="mt-2 btn btn-primary">イベント作成</button>
            </form>
            
        
    </div>
</div>
@endsection
