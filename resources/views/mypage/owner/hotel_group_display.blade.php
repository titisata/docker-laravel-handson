@extends('mypage.layouts.app')

@section('menu', 'category')
@section('content')

<style>
    .number_form{
        width:60px;
    }
    td{
        vertical-align:middle!important;
    }
</style>
<div class="container">
    

    <div class="row justify-content-center">
        <div class="col-md-9">
        <div class="d-flex">
            <h1>ホテルグループ一覧</h1>
            <a class="ms-3" href="/mypage/owner/hotel_group_insert" style="text-decoration: none; color: inherit;">
                <button class="btn btn-lg btn-success">新規作成</button>
            </a>
        </div>
    
            <table class="table table-hover "  style="width:800px">
                <thead>
                    <tr> 
                        <th scope="col">ホテルグループ名</th>
                        <th scope="col">大人料金</th>
                        <th scope="col">子供料金</th>
                        <th scope="col">所属ホテル</th>   
                    </tr>
                </thead>
                @forelse ($hotel_groups as $hotel_group)
                    
                    <tr class="align-items-center">
                        <td style="width:200px">
                            <a class="link" href="/mypage/owner/hotel_group_edit/{{ $hotel_group->id }}">
                                {{ $hotel_group->name }}
                            </a>
                        </td>
                        <td style="width:100px">
                            <p class="card-text text-nowrap ">{{ number_format($hotel_group->price_adult) }}～</p>
                        </td>  
                        <td  style="width:100px">
                            <p class="card-text  text-nowrap ">{{ number_format($hotel_group->price_child) }}～</p>
                        </td>
                        <td>
                            @forelse( App\Models\HotelSelect::where('hotel_group_id', $hotel_group->id)->get(); as $hotel_select )
                                <div class='d-flex my-2'>
                                    <p class="mb-0">{{ $hotel_select->hotel->name }}</p>    
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
    </div>
</div>

@endsection