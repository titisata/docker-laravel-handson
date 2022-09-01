@extends('mypage.layouts.app')

@section('menu', 'partner_link')
@section('content')
    <h1>ようこそ {{ Auth::user()->name }} 様</h1>
    <h2>「{{ $name }}」の編集ページです</h2>
    <div class="card">
        <div class="card-body d-flex flex-column">
            
            <form action="/mypage/owner/action_link_edit" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="name" value="{{ $name }}">
                <label>「{{ $name }}」の内容</label>
                
                <textarea rows="50" cols="50" class="form-control" name="content">
                    {{ $link->content ?? ''}}
                </textarea>
                
                <button class="btn btn-primary">編集</button>
            </form>
                
        </div>
    </div>
@endsection
