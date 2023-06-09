@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">プロフィール</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>名前: {{ $user->name }}</p>
                    <p>メールアドレス: {{ $user->email }}</p>
                    
                </div>
            </div>

            

            <div class="card mt-3">
                <div class="card-header">管理情報</div>

                <div class="card-body">
                @role('system_admin|site_admin')
                    <div>
                        <a href="/mypage/owner">管理画面へ</a>
                    </div>
                @endrole 
                @role('partner')
                    <div>
                        <a href="/mypage/partner">管理画面へ</a>
                    </div>
                @endrole    
                @role('user')
                    <div>
                        <a href="/mypage/user">管理画面へ</a>
                    </div>
                @endrole  
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">予約した体験</div>
                <div class="card-body">
                    @forelse ($reserved_experiences as $reserved_experience)
                        <a href="/experience/{{ $reserved_experience->experience->experience_folder_id }}">
                            <div class="mt-1 p-3 card">
                                <div>
                                    <p>{{ $reserved_experience->user->name }}</p>
                                    <p>{{ $reserved_experience->experience->name }}</p>
                                    <p>予約日: {{ $reserved_experience->experience->start_date }}</p>
                                    <p>大人: {{ $reserved_experience->quantity_adult }}人 子ども: {{ $reserved_experience->quantity_child }}人</p>
                                    <p>宿泊: {{ $reserved_experience->hotelGroup?->name ?? 'なし' }}</p>
                                    <p>食事: {{ $reserved_experience->foodGroup?->name ?? 'なし' }}</p>
                                    <p>連絡事項: {{ $reserved_experience->message }}</p>
                                    <p>金額: {{ number_format($reserved_experience->sum_price()) }}円</p>
                                </div>
                            </div>
                        </a>
                    @empty

                    @endforelse
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">注文した{{App\Consts\ReuseConst::GOODS}}</div>
                <div class="card-body">
                    @forelse ($ordered_goods as $ordered_goods_one)
                        <a href="/goods/{{ $ordered_goods_one->goods->goods_folder_id }}">
                            <div class="mt-1 p-3 card">
                                <div>
                                    <p>名前: {{ $ordered_goods_one->goods->name }}</p>
                                    <p>個数: {{ $ordered_goods_one->quantity }}</p>
                                    <p>金額: {{ number_format($ordered_goods_one->sum_price()) }}円</p>
                                </div>
                            </div>
                        </a>
                    @empty

                    @endforelse
                </div>
            </div>

            </div>
        </div>
    </div>
@endsection
