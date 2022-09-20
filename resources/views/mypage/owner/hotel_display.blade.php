@extends('mypage.layouts.app')

@section('menu', 'category')
@section('content')

<div class="container">
    <h1>ホテル一覧</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
            <div class="card-header d-flex">
                <p>ホテル編集</p>
                <a href="/mypage/owner/hotel_insert" > 
                    <div class="d-flex">
                        <button type="submit" class="btn btn-sm btn-primary mx-2" name="update">追加</button>
                    </div>
                </a>
            </div>
                <div class="card-body">

                    <p>現在登録中のホテル</p>
                        
                    <div class="d-flex flex-column">
                    @foreach( $hotels as $hotel)
                        <div class='d-flex my-2'>
                            
                            <div class="d-flex">
                                <p class="mb-0">{{ $hotel->name }}</p>
                                <a href="/mypage/owner/hotel_edit/{{ $hotel->id }}">
                                    <button class="btn btn-sm btn-primary mx-2" name="update">編集</button>
                                </a>
                            </div>
                             
                            <form action="/mypage/owner/hotel_delete" method="POST">
                                @csrf 
                                <button type="submit" class="btn btn-sm btn-danger mx-2 mb-0"  name="delete">削除</button>
                                <input type="hidden" name="id" value="{{ $hotel->id }}">
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