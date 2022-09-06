@extends('mypage.layouts.app')

@section('menu', 'partner_link')
@section('content')
    
    <h2>「{{ $link->name }}」のページです</h2>
    <div class="card">
        <div class="card-body d-flex flex-column">
            
            <form action="/mypage/partner/action_link_edit" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $link->id }}">
                <label for="">
                    テキストタイトル
                    <input type="text" class="form-control" name="name" value="{{ $link->name }}">
                </label>
                
                
                <textarea rows="50" cols="50" class="form-control" name="content">
                    {{ $link->content ?? ''}}
                </textarea>
                
                <button class="btn btn-primary">編集</button>
            </form>
                
        </div>
    </div>
@endsection
