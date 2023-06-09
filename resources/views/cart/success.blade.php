@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <h3 class="mb-3">ご購入ありがとうございました。良い旅を！</h3> 
            @role('system_admin|site_admin|partner')
                <a class="dropdown-item" href="{{ url('/mypage/partner/') }}">マイページへ</a>
            @endrole
            @role('user')
                <a class="dropdown-item" href="{{ url('/mypage/user/') }}">マイページへ</a>
            @endrole 
        </div>
    </div>
</div>

@endsection
