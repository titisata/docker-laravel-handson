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
                
                <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">提供料理名</th>
                    <th scope="col">提供料理情報</th>
                    <th scope="col">削除ボタン</th>
                </tr>
            </thead>
            @forelse($foods as $food)
                <tr class="align-items-center">
                    <th scope="row">{{$food->id }}</th>
                    <td>
                        <a href="/mypage/owner/food_edit/{{ $food->id }}">
                            {{ $food->name }}
                        </a>  
                    </td>
                    <td>
                    
                    <p class="card-text fw-bold text-nowrap ">{{ $food->description }}</p>
                    </td>
                    <td>
                        <form action="/mypage/owner/food_delete" method="POST">
                            @csrf 
                            <button type="submit" class="btn btn-sm btn-danger mx-2 mb-0"  name="delete">削除</button>
                            <input type="hidden" name="id" value="{{ $food->id }}">
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