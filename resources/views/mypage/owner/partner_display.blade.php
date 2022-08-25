@extends('mypage.layouts.app')

@section('menu', 'partner_display')
@section('content')
<div class="container">
    <div class="d-flex">
        <h1>パートナー一覧</h1>
        <a href="/mypage/owner/partner_new" style="text-decoration: none; color: inherit;">
            <button class="btn btn-sm btn-success ms-5">新規作成</button>
        </a>
    </div>
    
    <div class="row justify-content-center">
    @forelse ($partners as $partner)
        <div class="col-md-8">
            <div class="card mt-3">
                <a href="/mypage/owner/partner_manege/{{ $partner->id }}" style="text-decoration: none; color: inherit;">
                    <div class="card-header">{{ $partner->name }}様</div>
                    
                    </div>
                </a>    
            </div>
    @empty
        <p>パートナーがいません</p>
    @endforelse
        </div>
    </div>
</div>
@endsection
