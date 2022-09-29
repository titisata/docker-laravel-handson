@extends('mypage.layouts.app')

@section('menu', 'owner_reserve_edit')
@section('content')
<style>
    .form{
        width:360px;
    }
</style>
<div class="container">
    <h1>ホテルグループ編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card mt-3">
                <div class="card-header">ホテルグループ編集</div>
                @if(count($errors) > 0)
                    <p class="text-danger">入力に問題があります。再入力してください</p>
                @endif
                <div class="card-body">
                    <form action="/mypage/owner/action_hotel_group_edit" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $hotel_group->id }}">
                        <div>
                            <label for="">
                                グループ名
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="text" class="form form-control" name="name" value="{{ $hotel_group->name }}">
                            </label>
                        </div>
                        
                        <div>
                            <label for="">
                                説明文
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <textarea type="text" class="form form-control" name="description" rows="5">{{ $hotel_group->description }}</textarea>
                            </label>
                        </div>
                        <div>
                            <label for="">
                                大人料金
                                @error('price_adult')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="text" class="form form-control" name="price_adult" value="{{ $hotel_group->price_adult }}">
                            </label>

                        </div>
                        <div>
                            <label for="">
                                子供料金
                                @error('price_child')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="text" class="form form-control" name="price_child" value="{{ $hotel_group->price_child }}">
                            </label>

                        </div>

                        <div>
                            <label for="">
                                所属ホテル
                                
                                @forelse( $hotel_selects as $hotel_select )
                                <div class='d-flex my-2'>
                                    <div class="d-flex">
                                        <p class="mb-0">{{ $hotel_select->hotel->name }}</p>    
                                    </div>
                                </div>
                                @empty
                                    <p>所属ホテルはありません</p>
                                @endforelse
                            </label>

                        </div>

                       
                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                    <form class="mt-2" action="/mypage/owner/action_hotel_group_delete" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">削除</button>
                        <input type="hidden" name="id" value="{{ $hotel_group->id }}">
                    </form>
                    
            
                </div>
            </div>  
        </div>
    </div>
    
</div>
@endsection
