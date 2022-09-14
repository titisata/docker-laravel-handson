@extends('mypage.layouts.app')

@section('menu', 'owner_reserve_edit')
@section('content')
<div class="container">
    <h1>ホテルグループ編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card mt-3">
                <div class="card-header">ホテルグループ編集</div>
                <div class="card-body">
                    <form action="/mypage/owner/action_hotel_group_edit" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $hotel_group->id }}">
                        <div>
                            <label for="">
                                グループ名
                                <input type="text" class="form-control" name="name" value="{{ $hotel_group->name }}">
                            </label>
                        </div>
                        
                        <div>
                            <label for="">
                                説明文
                                <textarea type="text" class="form-control" name="description">{{ $hotel_group->description }}</textarea>
                            </label>
                        </div>
                        <div>
                            <label for="">
                                大人料金
                                <input type="text" class="form-control" name="price_adult" value="{{ $hotel_group->price_adult }}">
                            </label>

                        </div>
                        <div>
                            <label for="">
                                子供料金
                                <input type="text" class="form-control" name="price_child" value="{{ $hotel_group->price_child }}">
                            </label>

                        </div>

                        <div>
                            <label for="">
                                所属ホテル
                                
                                @forelse( $hotel_selects as $hotel_select )
                                <div class='d-flex my-2'>
                                    
                                        <div class="d-flex">
                                            <p class="mb-0">{{ $hotel_select->hotel->name }}</p>    
                                            <button type="submit" class="btn btn-sm btn-danger mx-2 mb-0"  name="delete">削除</button>
                                            <input type="hidden" name="hotel_select_id" value="{{ $hotel_select->hotel->id }}">
                                        </div>
                                   
                                </div>
                                @empty
                                    <p>所属ホテルはありません</p>
                                @endforelse
                            </label>

                        </div>

                       
                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
            
                </div>
            </div>  
        </div>
    </div>
    
</div>
@endsection
