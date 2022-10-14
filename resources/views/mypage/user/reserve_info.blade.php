@extends('mypage.layouts.app')

@section('menu', 'owner_reserve_edit')
@section('content')
<div class="container">
    <h1>予約{{App\Consts\ReuseConst::EVENT}}詳細</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
        <p class="text-danger">{{ session('result') }}</p>
            <div class="card mt-3">
                <div class="card-header">予約{{App\Consts\ReuseConst::EVENT}}詳細</div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-header">予約{{App\Consts\ReuseConst::EVENT}}情報</div>
                            <div class="mb-3 ms-2">
                                @forelse(App\Models\Image::where('table_name', 'experience_folders')->where('table_id',$reserved_experience->experience->experience_folder_id)->get() as $image)
                                    @if($loop->first)    
                                        <div class="d-flex flex-column col-4 my-3">
                                            <img class="card-img" style="width: 200px;height: 140px; object-fit: cover;" src="{{ $image->image_path }}" alt="">
                                        </div>
                                    @endif
                                @empty
                                @endforelse        
                            </div>
                            <div class="mb-3 ms-2">
                                <a class="link" href="/experience/{{$experience_folder->id}}">
                                    <p>予約体験名：{{ $experience_folder->name }}</p>
                                </a>
                                <p>予約時間帯：{{ $reserved_experience->experience->name }}</p>
                            </div>
                            <div class="mb-3 ms-2">
                                <p>
                                    体験料金：大人：{{  number_format($reserved_experience->experience->price_adult) }}円
                                    子ども：{{  number_format($reserved_experience->experience->price_child) }}円
                                </p>
                            </div>
                            <div class="mb-3 ms-2">
                                <p>
                                    体験先住所：{{ $experience_folder->address }}
                                </p>
                            </div>
                            
                            <div class="mb-3 ms-2">
                                <p>
                                    お問合せ先：{{ $experience_folder->phone }}
                                </p>
                            </div>
                        </div>
                   

                    <div class="card mt-3">
                        <div class="card-header">予約内容</div>
                        <div class="my-3 ms-2">
                            <p>予約者名：{{ $user->name }}様</p>
                        </div>

                        <div class="mb-3 ms-2">
                            
                            <p>予約日:{{ $reserved_experience->start_date }}</p>
                        </div>
                    
                        <div class="mb-3 ms-2">
                            <p>大人：{{ $reserved_experience->quantity_adult }}名</p>
                            <p>子ども：{{ $reserved_experience->quantity_child }}名</p>
                        </div>
                        <div class="mb-3 ms-2">
                            <p>宿泊グループ：{{ $reserved_experience->hotelGroup?->name ?? 'なし' }}</p>
                            <p>宿泊ホテル：{{ $reserved_experience->hotel?->name ?? '未確定' }}</p>
                        </div>
                        <div class="mb-3 ms-2">
                            <p>食事グループ：{{ $reserved_experience->foodGroup?->name ?? 'なし' }}</p>
                            <p>食事プラン：{{ $reserved_experience->food?->name ?? '未確定' }}</p>
                        </div>
                        <div class="mb-3 ms-2">
                            <p>連絡事項:{{ $reserved_experience->comment }}</p>
                        </div>
                        

                    </div>

                    <div class="card mt-3">
                        <div class="card-header">Google Map</div>

                        <div>
                            <iframe
                                width="100%"
                                height="300"
                                frameborder="0" style="border:0"
                                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCbEnku7Kl5mCIvWZgKOpgN-2wjmehRvyU&q={{ $experience_folder->address }}"
                                allowfullscreen>
                            </iframe>

                        </div>
                    </div>
            
                
            </div>  
        </div>
    </div>
    
</div>
@endsection
