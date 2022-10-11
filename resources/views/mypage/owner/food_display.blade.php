@extends('mypage.layouts.app')

@section('menu', 'category')
@section('content')

<div class="container">
    <div class="d-flex">
        <h1>フード一覧</h1>
        <a class="ms-3" href="/mypage/owner/food_insert" >          
            <button class="btn btn-lg btn-success">新規作成</button>
        </a>
    </div> 
    <div class="row justify-content-center">
        <div class="col-md-9">
        
            <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">提供料理名</th>
                    <th scope="col">提供料理情報</th>
                </tr>
            </thead>
            @forelse($foods as $food)
                <tr class="align-items-center">
                    <td>     
                        <a class="link" href="/mypage/owner/food_edit/{{ $food->id }}">
                            {{ $food->name }} 
                        </a>  
                    </td>
                    <td>
                        <p class="card-text text-nowrap ">{{ $food->description }}</p>
                    </td>
                </tr>   
                @empty
                    <p>登録ホテルはありません</p>
                @endforelse
            </table>
        </div>
    </div>
</div>

@endsection