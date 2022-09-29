@extends('mypage.layouts.app')

@section('menu', 'owner_home')
@section('content')
<div class="container">

    <h1>ようこそ {{ Auth::user()->name }} 様</h1>
    <div class="card">
        <div class="card-body">
            <p>名前: {{ Auth::user()->name }}</p>
            <p>メールアドレス: {{ Auth::user()->email }}</p>
            
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header d-flex">
            <p class="mb-0">予約された体験</p>
            <p class="mb-0 ms-3">本日と明日</p>
        </div>
        <div class="card-body">
        <table class="table table-hover">
            @forelse ($reserved_experiences as $reserved_experience)
                @if ($loop->first)
                    <thead>
                        <tr>
                            <th scope="col">予約者名</th>
                            <th scope="col">予約体験名</th>
                            <th scope="col">体験日</th>
                            <th scope="col">人数</th>
                            <th scope="col">宿泊</th>
                            <th scope="col">食事</th>
                            <th scope="col">連絡事項</th>
                            <th scope="col">ホテル選定</th>
                        </tr>
                    </thead>
                @endif
                <tr>
                    <td>
                        <p>{{ $reserved_experience->user->name }}様</p>
                    </td>
                    
                    <td>
                        <div class="d-flex flex-column">
                           
                            @if(App\Models\ExperienceFolder::where('id',$reserved_experience->experience->experience_folder_id)->first()->is_lodging == 0)
                                <p class="text-success">宿泊なし</p>
                            @else
                                <p class="text-primary">宿泊あり</p>
                            @endif
                            <p>{{ App\Models\ExperienceFolder::where('id',$reserved_experience->experience->experience_folder_id)->first()->name }}</p>
                            <p>{{ $reserved_experience->experience->name }}</p>
                           
                        </div> 
                    </td>
                    <td>
                        <p>{{ $reserved_experience->start_date }}</p>
                    </td>
                    
                    <td>
                        <p>
                            大人：{{ $reserved_experience->quantity_adult }}名<br>
                            子ども：{{ $reserved_experience->quantity_child }}名
                        </p>
                    </td>
                    <td>
                        <p>{{ $reserved_experience->hotelGroup?->name ?? 'なし' }}</p>
                    </td>
                    <td>
                        <p>{{ $reserved_experience->foodGroup?->name ?? 'なし' }}</p>
                    </td>
                    <td>
                        <p>{{ $reserved_experience->message }}</p>
                    </td>
                    <td> 
                        @if( $reserved_experience->status == '対応待ち')
                            <p class="bg-danger text-white mb-0 text-center">{{ $reserved_experience->status }}</p>
                        @else
                            <p class="bg-primary text-white mb-0 text-center">{{ $reserved_experience->status }}</p>
                        @endif
                    </td>
                </tr>
                
            @empty

            @endforelse
            </table>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">注文されたお土産</div>
        <div class="card-body">
            @forelse ($ordered_goods as $ordered_goods_one)
                <a href="/goods/{{ $ordered_goods_one->goods->id }}">
                    <div class="mt-1 p-3 card">
                        <div>
                            <p>名前: {{ $ordered_goods_one->goods->name }}</p>
                            <p>個数: {{ $ordered_goods_one->quantity }}</p>
                        </div>
                    </div>
                </a>
            @empty

            @endforelse
        </div>
    </div>
</div>
@endsection
