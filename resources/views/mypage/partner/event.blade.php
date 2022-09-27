
@extends('mypage.layouts.app')

@section('menu', 'partner_event')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex">
                <h1>イベント一覧</h1>
                <a href="/mypage/partner/event_add/{{ $user->id }}">
                    <div class="btn btn-success">
                        新規登録     
                    </div>
                </a>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">イベント名</th>
                        <th scope="col">設定画像</th>
                        <th scope="col">目安料金</th>
                        <th scope="col">イベント削除ボタン</th>
                    </tr>
                </thead>
                @forelse ($experiences_folders as $experienceFolder)
                    <tr class="align-items-center">
                        <th scope="row">{{ $experienceFolder->id }}</th>
                        <td>
                            <a href="/mypage/partner/event/{{ $experienceFolder->id }}" style="text-decoration: none; color: inherit;">
                            {{ $experienceFolder->name }}
                            </a> 
                        </td>
                        <td>
                            <img style="object-fit: cover; height: 50px; width: 100px; " class="rounded-top image" src="{{ $experienceFolder->images()[0]?->image_path ?? '/images/empty.png'}}" alt="Card image cap">
                        </td>  
                        <td>
                            <p class="card-text fw-bold text-nowrap ">￥{{ number_format($experienceFolder->price_child) }}～</p>
                        </td>
                        <td>
                            <form action="/mypage/partner/action_event_delete" method="POST">
                            @csrf
                            <button class="btn btn-danger">イベント削除</button>
                            <input type="hidden" name="id" value="{{ $experienceFolder->id }}">
                            </form>
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

