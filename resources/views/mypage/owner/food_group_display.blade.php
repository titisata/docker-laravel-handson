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
    
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">フードグループ名</th>
                <th scope="col">大人料金</th>
                <th scope="col">子供料金</th>
                <th scope="col">提供料理</th>
            </tr>
        </thead>
        @forelse ($food_groups as $food_group)
            <tr class="align-items-center">
                <th scope="row">{{ $food_group->id }}</th>
                <td>
                    <a href="/mypage/owner/food_group_edit/{{ $food_group->id }}" style="text-decoration: none; color: inherit;">
                        {{ $food_group->name }}
                    </a>  
                </td>
                <td>
                <p class="card-text fw-bold text-nowrap ">{{ number_format($food_group->price_adult) }}～</p>
                </td>  
                <td>
                <p class="card-text fw-bold text-nowrap ">{{ number_format($food_group->price_child) }}～</p>
                </td>
                <td>
                @forelse( App\Models\FoodSelect::where('food_group_id', $food_group->id)->get(); as $food_select )
                <div class='d-flex my-2'>
                    <div class="d-flex">
                        <p class="mb-0">{{ $food_select->food->name }}</p>    
                    </div>
                </div>
                @empty
                    <p>提供料理はありません</p>
                @endforelse
                </td>
            </tr>   
        @empty
        <p>フードグループはありません</p>
        @endforelse
    </table>
</div>

@endsection