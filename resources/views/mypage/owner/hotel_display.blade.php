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

            <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ホテル名</th>
                    <th scope="col">ホテル情報</th>
                    <th scope="col">住所</th>
                    <th scope="col">メールアドレス</th>
                    <th scope="col">削除ボタン</th>
                </tr>
            </thead>
            @forelse($hotels as $hotel)
                <tr class="align-items-center">
                    <th scope="row">{{$hotel->id }}</th>
                    <td>
                        <a href="/mypage/owner/hotel_edit/{{ $hotel->id }}">
                            {{ $hotel->name }}
                        </a>  
                    </td>
                    <td>
                    
                    <p class="card-text fw-bold text-nowrap ">{{ $hotel->description }}</p>
                    </td>
                    <td>
                    <p class="card-text fw-bold text-nowrap ">{{ $hotel->address }}</p>
                    </td>  
                    <td>
                    <p class="card-text fw-bold text-nowrap ">{{ $hotel->mail }}</p>
                    </td>
                    <td>
                        <form action="/mypage/owner/hotel_delete" method="POST">
                            @csrf 
                            <button type="submit" class="btn btn-sm btn-danger mx-2 mb-0"  name="delete">削除</button>
                            <input type="hidden" name="id" value="{{ $hotel->id }}">
                        </form>
                    </td>
                </tr>   
            @empty
                <p>登録ホテルはありません</p>
            @endforelse
        </table>
            </div>
            
        </div>
    </div>
</div>

@endsection