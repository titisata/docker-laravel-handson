@extends('mypage.layouts.app')

@section('menu', 'category')
@section('content')

<div class="container">
    <h1>フード一覧</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
            <div class="card-header d-flex">
                <p>フード編集</p>
                <a href="/mypage/owner/food_insert" > 
                    <div class="d-flex">
                        <button type="submit" class="btn btn-sm btn-primary mx-2" name="update">追加</button>
                    </div>
                </a>
            </div>
                <div class="card-body">

                    <p>現在登録中のフード</p>
                        
                    <div class="d-flex flex-column">
                    @foreach( $foods as $food)
                        <div class='d-flex my-2'>
                            
                            <div class="d-flex">
                                <p class="mb-0">{{ $food->name }}</p>
                                <a href="/mypage/owner/food_edit/{{ $food->id }}">
                                    <button class="btn btn-sm btn-primary mx-2" name="update">編集</button>
                                </a>
                            </div>
                             
                            <form action="/mypage/owner/food_delete" method="POST">
                                @csrf 
                                <button type="submit" class="btn btn-sm btn-danger mx-2 mb-0"  name="delete">削除</button>
                                <input type="hidden" name="id" value="{{ $food->id }}">
                            </form>

                        
                        </div>
                    @endforeach 
                    
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection