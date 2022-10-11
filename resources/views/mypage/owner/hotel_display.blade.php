@extends('mypage.layouts.app')

@section('menu', 'category')
@section('content')

<div class="container"> 
    <div class="d-flex">
        <h1>ホテル一覧</h1>
        <a class="ms-3" href="/mypage/owner/hotel_insert" > 
            <button class="btn btn-lg btn-success">新規作成</button>
        </a>
    </div>     
    <div class="row justify-content-center">
        <div class="col-md-9">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ホテル名</th>
                        <th scope="col">ホテル情報</th>
                        <th scope="col">住所</th>
                        <th scope="col">メールアドレス</th>
                        
                    </tr>
                </thead>
                @forelse($hotels as $hotel)
                    <tr class="align-items-center">
                        <td>
                            <div class="my-2">
                                <a class="link" href="/mypage/owner/hotel_edit/{{ $hotel->id }}">
                                    {{ $hotel->name }}
                                </a> 
                            </div>         
                        </td>
                        <td>     
                        <div class="my-2">  
                            <p class="card-text text-nowrap ">{{ $hotel->description }}</p>
                        </div>    
                        </td>
                        <td>
                            <div class="my-2">
                            <p class="card-text text-nowrap ">{{ $hotel->address }}</p>
                            </div>
                           
                        </td>  
                        <td>
                            <div class="my-2">
                            <p class="card-text text-nowrap ">{{ $hotel->mail }}</p>
                            </div>
                            
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