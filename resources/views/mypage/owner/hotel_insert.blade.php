
@extends('mypage.layouts.app')

@section('menu', 'owner_reserve_edit')
@section('content')
<style>
    .form{
        width:360px;
    }
</style>
<div class="container">
    <h1>ホテル新規作成</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">ホテル新規作成</div>
                <div class="card-body">
                    <form action="/mypage/owner/action_hotel_insert" method="POST">
                    @csrf
                    @if(count($errors) > 0)
                        <p class="text-danger">入力に問題があります。再入力してください</p>
                    @endif
                    <div>
                        <label for="">
                            ホテル名
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="name" type="text" class="form form-control">
                        </label>
                    </div>
                    <div>
                        <label>
                            ホテル情報
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="description" type="text" class="form form-control"  rows="5"></textarea>
                        </label>
                    </div>
                    <div>
                        <label for="">
                            住所
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="address" type="text" class="form form-control" value="">
                        </label>
                    </div>
                    <div>
                        <label for="">
                            メールアドレス
                            @error('mail')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="mail" type="email" class="form form-control" value="">
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
                    </form>
                </div>
            </div>  
        </div>
    </div>
    
</div>
@endsection
