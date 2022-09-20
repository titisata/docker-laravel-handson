@extends('mypage.layouts.app')

@section('menu', 'category')
@section('content')
    <form action="/mypage/owner/action_hotel_insert" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">新しいホテル</label>
            <div>
                <label for="">
                    ホテル名
                    <input name="name" type="text" class="form-control" value="">
                </label>
            </div>
            <div>
                <label>
                    ホテル情報
                    <textarea name="description" type="text" class="form-control"></textarea>
                </label>
            </div>
            <div>
                <label for="">
                    住所
                    <input name="address" type="text" class="form-control" value="">
                </label>
            </div>
            <div>
                <label for="">
                    メールアドレス
                    <input name="mail" type="email" class="form-control" value="">
                </label>
            </div>

            <div>
                <label for="">
                    所属グループ選択
                    
                    @forelse($hotel_groups as $hotel_group)
                    <div>
                        <input type="checkbox" id="{{ $hotel_group->name }}" name="hotel_group[]" value="{{ $hotel_group->id }}">
                        <label for="{{ $hotel_group->name }}">{{ $hotel_group->name }}</label>
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

@endsection