@extends('mypage.layouts.app')

@section('menu', 'owner_reserve_edit')
@section('content')
<div class="container">
    <h1>フードグループ編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card mt-3">
                <div class="card-header">フードグループ編集</div>
                <div class="card-body">
                    <form action="/mypage/owner/action_food_group_edit" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $food_group->id }}">
                        <div>
                            <label for="">
                                グループ名
                                <input type="text" class="form-control" name="name" value="{{ $food_group->name }}">
                            </label>
                        </div>
                        
                        <div>
                            <label for="">
                                説明文
                                <textarea type="text" class="form-control" name="description">{{ $food_group->description }}</textarea>
                            </label>
                        </div>
                        <div>
                            <label for="">
                                大人料金
                                <input type="text" class="form-control" name="price_adult" value="{{ $food_group->price_adult }}">
                            </label>

                        </div>
                        <div>
                            <label for="">
                                子供料金
                                <input type="text" class="form-control" name="price_child" value="{{ $food_group->price_child }}">
                            </label>

                        </div>

                        <div>
                            <label for="">
                                所属フードグループ
                                
                                @forelse( $food_selects as $food_select )
                                <div class='d-flex my-2'>
                                    
                                        <div class="d-flex">
                                            <p class="mb-0">{{ $food_select->food->name }}</p>    
                                        </div>
                                   
                                </div>
                                @empty
                                    <p>所属フードグループはありません</p>
                                @endforelse
                            </label>

                        </div>

                       
                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                    <form class="mt-2" action="/mypage/owner/action_food_group_delete" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">削除</button>
                        <input type="hidden" name="id" value="{{ $food_group->id }}">
                    </form>
            
                </div>
            </div>  
        </div>
    </div>
    
</div>
@endsection
