@extends('mypage.layouts.app')

@section('menu', 'user_reserve')
@section('content')
<div class="container">
    <h1>予約一覧</h1>
    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card-body">
        <table class="table table-hover">
            @forelse ($reserved_experiences as $reserved_experience)
                @if ($loop->first)
                    <thead>
                        <tr>
                            <th scope="col">予約体験名</th>
                            <th scope="col">体験日</th>
                            <th scope="col">予約人数</th>
                            <th scope="col">宿泊</th>
                            <th scope="col">食事</th>
                            <th scope="col">連絡事項</th>
                            <th scope="col">連絡先</th>
                            <th scope="col">金額</th>
                        </tr>
                    </thead>
                @endif
                <tr>
                    
                    <td>
                        <div class="d-flex flex-column">
                        <a class="link" href="/experience/{{ $reserved_experience->experience->experience_folder_id }}">
                            @if(App\Models\ExperienceFolder::where('id',$reserved_experience->experience->experience_folder_id)->first()->is_lodging == 0)
                                <p class="text-success">宿泊なし</p>
                            @else
                                <p class="text-primary">宿泊あり</p>
                            @endif
                            <p>{{ App\Models\ExperienceFolder::where('id',$reserved_experience->experience->experience_folder_id)->first()->name }}</p>
                            <p>{{ $reserved_experience->experience->name }}</p>
                        </a>
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
                        <p>{{ App\Models\ExperienceFolder::where('id',$reserved_experience->experience->experience_folder_id)->first()->phone }}</p>
                    </td>
                    <td> 
                        <p>{{ number_format($reserved_experience->sum_price()) }}円</p>
                    </td>
                </tr>
                
            @empty

            @endforelse
            </table>
        </div>
    </div>

            
        </div>
    </div>
</div>
@endsection
