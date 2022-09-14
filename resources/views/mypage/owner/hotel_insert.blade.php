@extends('mypage.layouts.app')

@section('menu', 'category')
@section('content')
    <form action="/mypage/owner/action_hotel_insert" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">新しい体験ホテル</label>
            <div class="d-flex" style="width:300px">
                <label for="">
                    ホテル名
                    <input name="name" type="text" class="form-control" value="">
                </label>
            </div>
            <label for="">
                ホテル情報
                <textarea name="description" type="text" class="form-control"></textarea>
            </label>
            <div class="d-flex flex-wrap flex-column">
        </div>
            

            
            <button type="submit" class="btn btn-primary">追加</button>
        </div>                     
    </form>

@endsection