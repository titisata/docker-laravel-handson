@extends('mypage.layouts.app')

@section('menu', 'owner_reserve_edit')
@section('content')
<div class="container">
    <h1>フードグループ編集</h1>
    @if(count($errors) > 0)
        <p class="text-danger">入力に問題があります。再入力してください</p>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card mt-3">
                <div class="card-header">フードグループ編集</div>
                <div class="card-body">
                    <form action="/mypage/owner/action_food_group_insert" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <div>
                            <label for="">
                                グループ名
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="text" class="form-control" name="name" value="">
                            </label>
                        </div>
                        
                        <div>
                            <label for="">
                                説明文
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <textarea type="text" class="form-control" name="description"></textarea>
                            </label>
                        </div>
                        <div>
                            <label for="">
                                大人料金
                                @error('price_adult')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="text" class="form-control" name="price_adult" value="">
                            </label>

                        </div>
                        <div>
                            <label for="">
                                子供料金
                                @error('price_child')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="text" class="form-control" name="price_child" value="">
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
