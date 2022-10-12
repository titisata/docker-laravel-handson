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
        <a class="ms-3" href="/mypage/owner/food_group_insert" style="text-decoration: none; color: inherit;">
            <button class="btn btn-lg btn-success">新規作成</button>
        </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-9">
        
            <table class="table table-hover">
                <thead>
                    <tr>  
                        <th scope="col">フードグループ名</th>
                        <th scope="col">大人料金</th>
                        <th scope="col">子供料金</th>
                        <th scope="col">提供料理</th>
                    </tr>
                </thead>
                @forelse ($food_groups as $food_group)
                    <tr class="align-items-center">
                        <td style="width:200px">
                            <div class="my-2">
                                <a class="link" href="/mypage/owner/food_group_edit/{{ $food_group->id }}">
                                    {{ $food_group->name }}
                                </a>
                            </div>    
                        </td>
                        <td>
                            <div class="my-2">
                                <p class="text-nowrap mb-0">{{ number_format($food_group->price_adult) }}～</p>
                            </div>
                             
                        </td>  
                        <td>
                            <div class="my-2">
                                <p class="text-nowrap mb-0">{{ number_format($food_group->price_child) }}～</p>
                            </div>
                        </td>
                        <td>
                            @forelse( App\Models\FoodSelect::where('food_group_id', $food_group->id)->get(); as $food_select )
                            <div class='d-flex my-2'>
                               
                                <p class="mb-0">{{ $food_select->food->name }}</p>    
                                
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
    </div>
</div>

@endsection