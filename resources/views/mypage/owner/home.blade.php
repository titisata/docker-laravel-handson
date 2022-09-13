@extends('mypage.layouts.app')

@section('menu', 'owner_home')
@section('content')
    <h1>ようこそ {{ Auth::user()->name }} 様</h1>
    <h2>あなたは管理者です</h2>
    <div class="card">
        <div class="card-body">
            <p>名前: {{ Auth::user()->name }}</p>
            <p>メールアドレス: {{ Auth::user()->email }}</p>
            
        </div>
    </div>
@endsection
