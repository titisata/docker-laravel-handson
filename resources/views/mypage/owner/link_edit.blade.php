@extends('mypage.layouts.app')

@section('menu', 'partner_link')
@section('content')
    <h2>「{{ $name }}」編集ページ</h2>
    <div class="card">
        <div class="card-body d-flex flex-column">
            
            <form action="/mypage/owner/action_link_edit" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="name" value="{{ $name }}">
                <label>「{{ $name }}」の内容</label>
                @if(count($errors) > 0)
                    <p class="text-danger">入力に問題があります。再入力してください</p>
                @endif
                
                
                <textarea rows="50" cols="50" class="form-control" name="content">
                    {{ $link->content ?? ''}}
                </textarea>
                
                <button class="btn btn-primary">編集</button>
            </form>
                
        </div>
    </div>
@endsection
