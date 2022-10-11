@extends('mypage.layouts.app')

@section('menu', 'user_reserve')
@section('content')


<div class="container">
    <div class="d-lg-flex">
        <form action="/mypage/owner/sales_result" method="post">
            @csrf
            <div class="row g-1">
                <div class="col-auto">
                    <span class="form-control-plaintext">売上実績：</span>
                </div>
                <div class="col-auto">
                    <input class="form-control me-lg-1" name="start_day" type="date" style="width:200px" value="{{ $start_day }}">
                </div>
                <div class="col-auto">
                    <span class="form-control-plaintext">～</span>
                </div>
                <div class="col-auto">
                    <input class="form-control me-lg-1" name="end_day" type="date" style="width:200px" value="{{ $end_day }}">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" type="submit"><span class="form-control-plaintext text-white">ダウンロード</span></button>
                </div>
            </div>
        <form>
    </div>

</div>

@endsection