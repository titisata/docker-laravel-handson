@extends('mypage.layouts.app')

@section('menu', 'partner_home')
@section('content')
    
    <div class="card">
        <div class="card-body">
            <p>名前: {{ $user->name }}</p>
            <p>メールアドレス: {{ $user->email }}</p>
        </div>
    </div>

@endsection
