@extends('mypage.layouts.app')

@section('menu', 'partner_link')
@section('content')
    <h1>ようこそ {{ Auth::user()->name }} 様</h1>
    
    <div class="card">
        <div class="card-body d-flex flex-column">
            
            <form action="/mypage/partner/action_link_insert" method="POST">
                @csrf
                <div>
                <input type="hidden" name="partner_id" value="{{ Auth::user()->id }}">
                <label for="">
                    テキストタイトル
                    <input type="text" class="form-control" name="name" value="">
                </label>

                </div>
                
                
                <label>内容</label>
                
                <textarea rows="50" cols="50" class="form-control" name="content">
                   
                </textarea>
                
                <button class="btn btn-primary">編集</button>
            </form>
                
        </div>
    </div>
@endsection
