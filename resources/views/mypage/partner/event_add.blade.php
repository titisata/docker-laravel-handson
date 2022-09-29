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
    
</script>
<div class="container">
    <h1>イベント新規作成</h1>
    <div class="row justify-content-center">
        <div class="col-md-8 card mt-3">
            <form action="/mypage/partner/action_event_add" method="POST" enctype="multipart/form-data">
                @csrf
                
                <input name="user_id" type="hidden" value="{{ $user->id }}">
                    <div class="card-header">基本情報</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">名前</label>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="name" type="text" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">大人料金</label>
                            @error('price_adult')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="price_adult" type="number" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">子供料金</label>
                            @error('price_child')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="price_child" type="number" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">住所</label>
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="address" type="text" class="form-control">
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
                            <label class="form-label">説明</label>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="description" type="text" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">イベント詳細</label>
                            @error('detail')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="detail" type="text" class="form-control" rows="5" ></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">注意事項</label>
                            @error('caution')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="caution" type="text" class="form-control" rows="5"></textarea>
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
                                <input name="is_lodging" type="radio" class="" checked  value="1">
                                <label class="fw-normal">宿泊あり</label>
                                <input name="is_lodging" type="radio" class="" value="0">
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
                            @error('hotel_result')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            @forelse($hotel_groups as $hotel_group)
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
                        
                    

                <div class="card mt-3">
                    <div class="card-header">時間帯設定</div>
                    <div class="card-body">
                        
                        <div class="card mt-3 p-3 ex_data">
                            
                            <div class="mb-3">
                                <label class="form-label">体験の時間帯</label>
                                @error('ex_name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input name="ex_name" type="text" class="form-control" value="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">大人料金</label>
                                @error('ex_price_adult')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input name="ex_price_adult" type="number" class="form-control" value="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">子供料金</label>
                                @error('ex_price_child')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input name="ex_price_child" type="number" class="form-control" value="">
                            </div>
                            <div class="mb-3">
                                <div class="d-flex">
                                    <label class="form-label">表示の順番</label>
                                    <p class="mb-1 ms-3">小さい数ほど優先して表示されます。</p>
                                </div>
                                @error('ex_sort_no')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input name="ex_sort_no" type="number" class="form-control" value="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">上限人数</label>
                                @error('ex_quantity')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input name="ex_quantity" type="number" class="form-control" value="">
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
                        <input type="hidden" id="key_count" name="key_count" value="">
                       
                        <button type="button" class="mt-2 btn btn-primary" onclick="add_ex()">体験の時間帯追加</button>
                        
                    </div>
               
                    </div>
                
                <button type="submit" class="mt-2 btn btn-primary">イベント作成</button>
            </form>
            
        
    </div>
</div>
@endsection
