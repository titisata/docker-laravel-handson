@extends('mypage.layouts.app')

@section('menu', 'category')
@section('content')
<style>
    .form{
        width:360px;
    }
</style>
<div class="container">
    <h1>ホテル編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">ホテル編集</div>
                <div class="card-body">
                    <form action="/mypage/owner/action_hotel_edit" method="POST">
                        @csrf
                        <div class="mb-3">
                            @if(count($errors) > 0)
                                <p class="text-danger">入力に問題があります。再入力してください</p>
                            @endif
                            <input type="hidden" name='id' value="{{ $hotels->id }}">
                            <div>
                                <label for="">
                                    ホテル名
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input name="name" type="text" class="form form-control" value="{{ $hotels->name }}">
                                </label>
                            </div>
                            <div>
                                <label>
                                    ホテル情報
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <textarea name="description" type="text" class="form form-control" rows="5">{{ $hotels->description }}</textarea>
                                </label>
                            </div>
                            <div>
                                <label for="">
                                    住所
                                    @error('address')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input name="address" type="text" class="form form-control" value="{{ $hotels->address }}">
                                </label>
                            </div>
                            <div>
                                <label for="">
                                    メールアドレス
                                    @error('mail')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input name="mail" type="email" class="form form-control" value="{{ $hotels->mail }}">
                                </label>
                            </div>

                            <div>
                                <label for="">
                                    所属グループ選択
                                    @forelse($hotel_groups as $hotel_group)
                                        @if(in_array($hotel_group->id, $checked_hotels_group, true))
                                            <div>
                                                <input type="checkbox" id="{{ $hotel_group->name }}" name="hotel_group[]" value="{{ $hotel_group->id }}" checked >
                                                <label for="{{ $hotel_group->name }}">{{ $hotel_group->name }}</label>
                                            </div> 
                                        @else
                                            <div>
                                                <input type="checkbox" id="{{ $hotel_group->name }}" name="hotel_group[]" value="{{ $hotel_group->id }}">
                                                <label for="{{ $hotel_group->name }}">{{ $hotel_group->name }}</label>
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
                    <form action="/mypage/owner/hotel_delete" method="POST">
                        @csrf 
                        <button type="submit" class="btn btn-danger mb-0"  name="delete">削除</button>
                        <input type="hidden" name="id" value="{{ $hotels->id }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

