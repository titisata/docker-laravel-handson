@extends('mypage.layouts.app')

@section('menu', 'partner_display')
@section('content')
<div class="container">
    <div class="d-flex">
        <h1>パートナー一覧</h1>
        <!--<a href="/mypage/owner/partner_make" style="text-decoration: none; color: inherit;">
            <button class="btn btn-sm btn-success ms-5">新規作成</button>
        </a>-->
    </div>
    
    <div class="row justify-content-center">

    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">パートナー名</th>
        <th scope="col">設定画像</th>
        </tr>
    </thead>
    @forelse ($partners as $partner)
        <tr class="align-items-center">
            <th scope="row">{{ $partner->id }}</th>
            <td>
                <a href="/mypage/owner/partner_manege/{{ $partner->id }}" style="text-decoration: none; color: inherit;">
                   {{ $partner->name }}様  
                </a> 
            </td>
            <td>
                @forelse($partner->images() as $image)
                <img class="card-img" style="width: 100px;height: 50px; object-fit: cover;" src="{{ $image->image_path }}" alt="">
                @empty
                <!-- <img class="card-img" style="width: 100px;height: 50px; object-fit: cover;" src="{{'/images/empty.png'}}" alt=""> -->
                <p>未設定</p>
                @endforelse
            </td>  
        </tr>   
    @empty
        <p>パートナーがいません</p>
    @endforelse
    </table>
    </div>
</div>
@endsection
