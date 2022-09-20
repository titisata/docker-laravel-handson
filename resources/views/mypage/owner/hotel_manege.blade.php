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
                <form action="/mypage/owner/hotel_insert" method="POST"> 
                    @csrf
                    <div class="d-flex">
                        <button type="submit" class="btn btn-sm btn-primary mx-2" name="update">追加</button>
                        <input type="hidden" name="id" value="">
                    </div>
                
                </form>
            </div>
                <div class="card-body">

                    <p>現在登録中のホテル</p>
                        
                    <div class="d-flex flex-column">
                    @foreach( $hotels as $hotel)
                        <div class='d-flex my-2'>
                            <form action="/mypage/owner/action_hotel_edit" method="POST">
                                @csrf
                                <div class="d-flex">
                                    <p class="mb-0">{{ $hotel->name }}</p>
                                    
                                    <button type="submit" class="btn btn-sm btn-primary mx-2" name="update">編集</button>
                                    <input type="hidden" name="id" value="">
                                </div>
                            
                            </form>
                            
                            <form action="" method="POST">
                                @csrf 
                                <button type="submit" class="btn btn-sm btn-danger mx-2 mb-0"  name="delete">削除</button>
                                <input type="hidden" name="id" value="">
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