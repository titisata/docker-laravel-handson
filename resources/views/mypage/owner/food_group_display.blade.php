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
        <h1>フードグループ一覧</h1>
        <a href="/mypage/owner/food_group_insert" style="text-decoration: none; color: inherit;">
            <button class="btn btn-sm btn-success ms-5">新規作成</button>
        </a>
    </div>
    
    <div class="row justify-content-center">
    @forelse ($food_groups as $food_group)
        <div class="col-md-8">
            <div class="card mt-3">
                <a href="/mypage/owner/food_group_edit/{{ $food_group->id }}" style="text-decoration: none; color: inherit;">
                    <div class="card-header">{{ $food_group->name }}</div>
                    
                    </div>
                </a>    
            </div>
    @empty
        <p>フードグループはありません</p>
    @endforelse
        </div>
    </div>
</div>

@endsection