@extends('mypage.layouts.app')

@section('menu', 'category')
@section('content')
<div class="container">
    <h1>フード新規登録</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">フード新規登録</div>
                    <div class="card-body">
                        <form action="/mypage/owner/action_food_insert" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">新しいフード</label>
                                @if(count($errors) > 0)
                                    <p class="text-danger">入力に問題があります。再入力してください</p>
                                @endif
                                <div>
                                    <label for="">
                                        提供料理名
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <input name="name" type="text" class="form form-control" value="">
                                    </label>
                                </div>
                                <div>
                                    <label>
                                        提供料理情報
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <textarea name="description" type="text" class="form form-control" rows="5"></textarea>
                                    </label>
                                </div>

                                <div>
                                    <label for="">
                                        所属フードグループ選択
                                        @error('food_group')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        
                                        @forelse($food_groups as $food_group) 
                                        <div>
                                            <input type="checkbox" id="{{ $food_group->name }}" name="food_group[]" value="{{ $food_group->id }}">
                                            <label for="{{ $food_group->name }}">{{ $food_group->name }}</label>
                                        </div> 
                                        @empty
                                            <p>グループがありません</p>
                                        @endforelse
                                        </select>
                                    </label>
                                </div>
                                
                                
                                <button type="submit" class="btn btn-primary">追加</button>
                            </div>                     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection