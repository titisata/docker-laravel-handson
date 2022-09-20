@extends('mypage.layouts.app')

@section('menu', 'reserved_user')
@section('content')
<div class="container">
    <h1>顧客管理</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                @forelse( $reserved_users as $reserved_user)
                    <a href="/mypage/partner/user_info/{{ $reserved_user->user->id }}">
                        <p>{{ $reserved_user->user->name }}</p>
                    </a>
                @empty
                    <p>閲覧可能なユーザーがいません</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
