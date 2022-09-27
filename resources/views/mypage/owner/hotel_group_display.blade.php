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
        <a href="/mypage/owner/hotel_group_insert" style="text-decoration: none; color: inherit;">
            <button class="btn btn-sm btn-success ms-5">新規作成</button>
        </a>
    </div>
    
   

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ホテルグループ名名</th>
                <th scope="col">大人料金</th>
                <th scope="col">子供料金</th>
                <th scope="col">所属ホテル</th>
            </tr>
        </thead>
        @forelse ($hotel_groups as $hotel_group)
            <tr class="align-items-center">
                <th scope="row">{{ $hotel_group->id }}</th>
                <td>
                    <a href="/mypage/owner/hotel_group_edit/{{ $hotel_group->id }}" style="text-decoration: none; color: inherit;">
                        {{ $hotel_group->name }}
                    </a>  
                </td>
                <td>
                <p class="card-text fw-bold text-nowrap ">{{ number_format($hotel_group->price_adult) }}～</p>
                </td>  
                <td>
                <p class="card-text fw-bold text-nowrap ">{{ number_format($hotel_group->price_child) }}～</p>
                </td>
                <td>
                @forelse( App\Models\HotelSelect::where('hotel_group_id', $hotel_group->id)->get(); as $hotel_select )
                <div class='d-flex my-2'>
                    <div class="d-flex">
                        <p class="mb-0">{{ $hotel_select->hotel->name }}</p>    
                    </div>
                </div>
                @empty
                    <p>所属ホテルはありません</p>
                @endforelse
                </td>
            </tr>   
        @empty
            <p>ホテルグループはありません</p>
        @endforelse
    </table>
</div>

@endsection