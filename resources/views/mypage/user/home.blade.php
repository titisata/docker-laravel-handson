@extends('mypage.layouts.app')

@section('menu', 'user_home')
@section('content')
    <h1>ようこそ {{ Auth::user()->name }} 様</h1>
    <div class="card">
        <div class="card-body">
            <p>名前: {{ Auth::user()->name }}</p>
            <p>メールアドレス: {{ Auth::user()->email }}</p>
        </div>
    </div>

    <div class="card mt-3">
                <div class="card-header">予約した体験</div>
                <div class="card-body">
                    @forelse ($reserved_experiences as $reserved_experience)
                        <a href="/experience/{{ $reserved_experience->experience->id }}">
                            <div class="mt-1 p-3 card">
                                <div>
                                    <p>{{ $reserved_experience->experience->name }}</p>
                                    <p>予約日: {{ $reserved_experience->experience->start_date }}</p>
                                    <p>大人: {{ $reserved_experience->quantity_adult }}人 子ども: {{ $reserved_experience->quantity_child }}人</p>
                                    <p>宿泊: {{ $reserved_experience->hotelGroup?->name ?? 'なし' }}</p>
                                    <p>食事: {{ $reserved_experience->foodGroup?->name ?? 'なし' }}</p>
                                    <p>連絡事項: {{ $reserved_experience->message }}</p>
                                </div>
                            </div>
                        </a>
                    @empty

                    @endforelse
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">注文したお土産</div>
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
@endsection
