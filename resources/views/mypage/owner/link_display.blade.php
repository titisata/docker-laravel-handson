@extends('mypage.layouts.app')

@section('menu', 'partner_link')
@section('content')
<div class="container">
    <div class="d-flex align-items-center">
        <h2>必須表示ページの編集</h2>
        <p class="mb-0 ms-3">リンクの情報を登録することができます</p>
    </div>
    
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
</div>
@endsection
