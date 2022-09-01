@extends('mypage.layouts.app')

@section('menu', 'partner_link')
@section('content')
    <h1>ようこそ {{ Auth::user()->name }} 様</h1>
    <h2>必須表示ページの編集ページです</h2>
    <div class="card">
        <div class="card-body d-flex flex-column">
            <a href="/mypage/owner/link_edit/1">
                利用規約
            </a>
            <a href="/mypage/owner/link_edit/2">
                プライバシー規約
            </a>
            <a href="/mypage/owner/link_edit/3">
                特定商取引に基づく表示
            </a>
            <a href="/mypage/owner/link_edit/4">
                店舗情報
            </a>
            <a href="/mypage/owner/link_edit/5">
                ヘルプ・マニュアル
            </a>
            
        
        </div>
    </div>
@endsection
