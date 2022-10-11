@extends('mypage.layouts.app')

@section('menu', 'owner_reserve_edit')
@section('content')
<div class="container">
    <h1>お気に入り一覧</h1>
    <div class="row justify-content-center">
        <div class="col-md-9">
            
            @forelse($ex_favorites as $ex_favorite)
            
            <div class="mb-3 col-lg-6 mt-4 rounded-4 p-3">
                <div class="card contain" style="border-radius: 18px;">
                    <a href="/experience/{{$ex_favorite->favorite_id}} }}" style="text-decoration: none; color: inherit; ">
                        <div class="" style="height: 100%;">
                            <div class="card-body p-0">
                                <img style="object-fit: cover; width:100%; height:320px;  border-top-left-radius: 18px;border-top-right-radius: 18px;" class=" image" src="{{ App\Models\ExperienceFolder::where('id', $ex_favorite->favorite_id )->first()->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap">    
                                <h4 class="card-title text-start fw-bold ms-3 mt-3 text-truncate font-gray" >{{ App\Models\ExperienceFolder::where('id', $ex_favorite->favorite_id )->first()->name }}</h4> 
                                <p class="card-text text-wrap mt-3 text-truncate m-3 font-gray">{{ App\Models\ExperienceFolder::where('id', $ex_favorite->favorite_id )->first()->description }}</p>
                                <p class="card-text fw-bold fs-3 text-nowrap mt-3 text-end me-2 font-more-gray mb-4"><span class="small fw-normal" style="font-size:12px;">税込</span>{{ App\Models\ExperienceFolder::where('id', $ex_favorite->favorite_id )->first()->price_child }}<span class="small fw-normal me-3 " style="font-size:12px;">円/人~</span></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
                
            @empty
            @endforelse

            
            @forelse($goods_favorites as $goods_favorite)
            
            <div class="mb-3 col-lg-6 mt-4 rounded-4 p-3">
                <div class="card contain" style="border-radius: 18px;">
                    <a href="/goods/{{$goods_favorite->favorite_id}} }}" style="text-decoration: none; color: inherit; ">
                        <div class="" style="height: 100%;">
                            <div class="card-body p-0">
                                <img style="object-fit: cover; width:100%; height:320px;  border-top-left-radius: 18px;border-top-right-radius: 18px;" class=" image" src="{{ App\Models\GoodsFolder::where('id', $goods_favorite->favorite_id )->first()->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap">    
                                <h4 class="card-title text-start fw-bold ms-3 mt-3 text-truncate font-gray" >{{ App\Models\GoodsFolder::where('id', $goods_favorite->favorite_id )->first()->name }}</h4> 
                                <p class="card-text text-wrap mt-3 text-truncate m-3 font-gray">{{ App\Models\GoodsFolder::where('id', $goods_favorite->favorite_id )->first()->description }}</p>
                                <p class="card-text fw-bold fs-3 text-nowrap mt-3 text-end me-2 font-more-gray mb-4"><span class="small fw-normal" style="font-size:12px;">税込</span>{{ App\Models\GoodsFolder::where('id', $goods_favorite->favorite_id )->first()->price }}<span class="small fw-normal me-3 " style="font-size:12px;">円~</span></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
                
            @empty
            @endforelse
        </div>
    </div>
</div>


@endsection
