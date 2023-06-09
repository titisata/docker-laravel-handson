@extends('mypage.layouts.app')

@section('menu', 'partner_goods')
@section('content')
<div class="container">
    <div class="d-flex">
        <h1>{{App\Consts\ReuseConst::GOODS}}一覧</h1>
        <a class="ms-3" href="/mypage/partner/goods_add/{{ $user->id }}">
            <div class="btn btn-lg btn-success">
                新規登録     
            </div>
        </a>
    </div>
    <div class="row justify-content-center">
        <div class="">
            
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="width:400px;">{{App\Consts\ReuseConst::GOODS}}</th>
                        <th scope="col">設定画像</th>
                        <th scope="col">料金目安</th>
                        <th scope="col">カテゴリー</th>
                    </tr>
                </thead>
                @forelse ($goods_folders as  $goodsFolder)
                    <tr class="align-items-center">
                        <td>
                            <a class="link" href="/mypage/partner/goods/{{ $goodsFolder->id }}">
                                {{  $goodsFolder->name }}
                            </a> 
                        </td>
                        <td>
                            <img style="object-fit: cover; height: 50px; width: 100px; " class="rounded-top image" src="{{  $goodsFolder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap">
                        </td>  
                        <td>
                            <p class="card-text text-nowrap ">￥{{ number_format( $goodsFolder->price) }}～</p>
                        </td>
                        <td>
                            <p>
                                {{  $goodsFolder->category1 }}
                            </p>
                        </td>
                        
                    </tr>   
                @empty
                    <p>{{App\Consts\ReuseConst::GOODS}}登録がありません</p>
                @endforelse
            </table>
            
        </div>
    </div>
</div>
@endsection
