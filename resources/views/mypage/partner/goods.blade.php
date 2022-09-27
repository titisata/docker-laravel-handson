
@extends('mypage.layouts.app')

@section('menu', 'partner_goods')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <div class="d-flex">
                <h1>お土産一覧</h1>
                <a href="/mypage/partner/goods_add/{{ $user->id }}">
                    <div class="btn btn-success">
                        新規登録     
                    </div>
                </a>
            </div>
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="width:400px;">お土産名</th>
                        <th scope="col">設定画像</th>
                        <th scope="col">目安料金</th>
                        <th scope="col">お土産削除ボタン</th>
                    </tr>
                </thead>
                @forelse ($goods_folders as  $goodsFolder)
                    <tr class="align-items-center">
                        <th scope="row">{{ $goodsFolder->id }}</th>
                        <td>
                            <a href="/mypage/partner/goods/{{ $goodsFolder->id }}" style="text-decoration: none; color: inherit;">
                            {{  $goodsFolder->name }}
                            </a> 
                        </td>
                        <td>
                            <img style="object-fit: cover; height: 50px; width: 100px; " class="rounded-top image" src="{{  $goodsFolder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap">
                        </td>  
                        <td>
                            <p class="card-text fw-bold text-nowrap ">￥{{ number_format( $goodsFolder->price) }}～</p>
                        </td>
                        <td>
                            <form action="/mypage/partner/action_event_delete" method="POST">
                            @csrf
                            <button class="btn btn-danger">イベント削除</button>
                            <input type="hidden" name="id" value="{{  $goodsFolder->id }}">
                            </form>
                        </td>
                    </tr>   
                @empty
                    <p>パートナーがいません</p>
                @endforelse
            </table>
            
        </div>
    </div>
</div>
@endsection

