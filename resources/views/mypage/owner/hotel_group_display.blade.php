@extends('mypage.layouts.app')

@section('menu', 'category')
@section('content')

<style>
    .number_form{
        width:60px;
    }
</style>
<div class="container">
    <div class="d-flex">
        <h1>ホテルグループ一覧</h1>
        <a href="/mypage/owner/hotel_group_make" style="text-decoration: none; color: inherit;">
            <button class="btn btn-sm btn-success ms-5">新規作成</button>
        </a>
    </div>
    
    <div class="row justify-content-center">
    @forelse ($hotel_groups as $hotel_group)
        <div class="col-md-8">
            <div class="card mt-3">
                <a href="/mypage/owner/hotel_group_edit/{{ $hotel_group->id }}" style="text-decoration: none; color: inherit;">
                    <div class="card-header">{{ $hotel_group->name }}</div>
                    
                    </div>
                </a>    
            </div>
    @empty
        <p>ホテルグループはありません</p>
    @endforelse
        </div>
    </div>
</div>

@endsection