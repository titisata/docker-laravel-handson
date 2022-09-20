@extends('mypage.layouts.app')

@section('menu', 'category')
@section('content')
    <form action="/mypage/owner/action_food_edit" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">フード編集画面</label>
            <input type="hidden" name='id' value="{{ $foods->id }}">
            <div>
                <label for="">
                    提供料理名
                    <input name="name" type="text" class="form-control" value="{{ $foods->name }}">
                </label>
            </div>
            <div>
                <label>
                    提供料理情報
                    <textarea name="description" type="text" class="form-control">{{ $foods->description }}</textarea>
                </label>
            </div>


            <div>
                <label for="">
                    所属グループ選択
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
            
            
            <button type="submit" class="btn btn-primary">追加</button>
        </div>                     
    </form>

@endsection