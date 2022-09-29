@extends('mypage.layouts.app')

@section('menu', 'owner_event')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex">
                <h1>イベント一覧</h1>
                <a class="ms-3" href="/mypage/owner/event_add/{{ $user->id }}">
                    <div class="btn btn-success btn-lg">
                        新規登録     
                    </div>
                </a>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">イベント名</th>
                        <th scope="col">設定画像</th>
                        <th scope="col">大人料金</th>
                        <th scope="col">子供料金</th>
                    </tr>
                </thead>
                @forelse ($experiences_folders as $experienceFolder)
                    <tr class="align-items-center">
                        <td>
                            <a class="link" href="/mypage/owner/event/{{ $experienceFolder->id }}">
                                {{ $experienceFolder->name }}
                            </a>   
                        </td>
                        <td>
                            <img style="object-fit: cover; height: 50px; width: 100px; " class="rounded-top image" src="{{ $experienceFolder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap">
                        </td>  
                        <td>
                            <p class="card-text text-nowrap ">￥{{ number_format($experienceFolder->price_adult) }}～</p>
                        </td>
                        <td>
                            <p class="card-text text-nowrap ">￥{{ number_format($experienceFolder->price_child) }}～</p>
                        </td>
                      
                    </tr>   
                @empty
                    <p>パートナーがいません</p>
                @endforelse
            </table>
            
            
        </div>
    </div>
</div>
@endsection
