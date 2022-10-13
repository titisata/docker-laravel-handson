@extends('mypage.layouts.app')

@section('menu', 'user_home')
@section('content')
<div class="container">
    <h1>ようこそ {{ Auth::user()->name }} 様</h1>
    <div class="card">
        <div class="card-body">
            <p>名前: {{ Auth::user()->name }}</p>
            <p>メールアドレス: {{ Auth::user()->email }}</p>
        </div>
    </div>


    @foreach($data2 as $data)
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between">
            <p class="mb-0">{{ $data->created_at }}に予約・注文</p>
            <a href="/mypage/user/receipt/{{ $data->payment_id }}">
                <button class="btn btn-outline-dark">領収書</button>
            </a>
            
        </div>
        <div class="card-body">
        
            @forelse ($reserved_experiences->where('payment_id',  $data->payment_id) as $reserved_experience)
            <div class="d-flex flex-row card mt-3">
            
                <img style="object-fit: cover; width:240px; height:180px;" class=" image" src="{{App\Models\Image::where('table_id',$reserved_experience->experience->experience_folder_id)->where('table_name', 'experience_folders')->get()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap"> 
            
                <div class="d-flex flex-column">
                    <div class="d-flex">
                        
                        <a class="link ms-2" href="/mypage/user/reserve_info/{{$reserved_experience->id}}">
                            <p>{{ App\Models\ExperienceFolder::where('id',$reserved_experience->experience->experience_folder_id)->first()->name }}
                            {{ $reserved_experience->experience->name }}</p>
                        </a>
                        <p class="ms-2">体験日：{{ $reserved_experience->start_date }}</p>
                    </div>
                    
                    <p class="ms-2">
                        大人：{{ $reserved_experience->quantity_adult }}名
                        子ども：{{ $reserved_experience->quantity_child }}名
                    </p>
                
                    <p class="ms-2">宿泊：{{ $reserved_experience->hotelGroup?->name ?? 'なし' }}</p>
                
                    <p class="ms-2">食事：{{ $reserved_experience->foodGroup?->name ?? 'なし' }}</p>
                
                
                    <p class="ms-2">お問合せ先：{{ $reserved_experience->contact_info }}</p>
                    
                    <p class="ms-2">体験料金：{{ number_format($reserved_experience->sum_price()) }}円</p>
                </div>
            </div>
                 
            @empty
            @endforelse
        
            @forelse ($ordered_goods->where('payment_id', $data->payment_id) as $one_ordered_goods)
            <div class="d-flex flex-row card mt-3">
                
                <img style="object-fit: cover; width:240px; height:180px;" class=" image" src="{{App\Models\Image::where('table_id',$one_ordered_goods->goods->goods_folder_id)->where('table_name', 'goods_folders')->get()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap"> 
                
                <div class="d-flex">
                    <div class="d-flex flex-column ms-2">
                        <a class="link ms-2" href="/mypage/user/goods_reserve_info/{{$one_ordered_goods->id}}">
                            <p>
                                {{ App\Models\GoodsFolder::where('id',$one_ordered_goods->goods->goods_folder_id)->first()->name }}
                                {{ $one_ordered_goods->goods->name }}
                            </p>
                        </a>
                        
                    
                        <p>
                            注文日：{{$one_ordered_goods->created_at}}
                        </p>
                    
                        <p>
                            注文個数：{{$one_ordered_goods->quantity}}個
                        </p>
                    
                        <p>
                            お問合せ先：{{$one_ordered_goods->partner->name}}
                            {{$one_ordered_goods->contact_info}}
                        </p>

                        <p class="">請求料金：{{ number_format($one_ordered_goods->total_price)}}円</p> 

                    </div>
                    
                
                    
                      
                </div>        
            </div>
            @empty

            @endforelse
        
        
        
        </div>

    </div>
    
    
    @endforeach

@endsection
