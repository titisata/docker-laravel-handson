@extends('mypage.layouts.app')

@section('menu', 'partner_link')
@section('content')
    <h1>ようこそ {{ Auth::user()->name }} 様</h1>
    <h2>必須表示ページの編集ページです</h2>
    <div class="card">
        
        <div>
            @forelse($links as $link)
                <div class="card-body d-flex flex-column">
                    <a href="/mypage/partner/link_edit/{{ $link->id }}">
                        {{ $link->name }}
                    </a>
                    <form action="/mypage/partner/action_link_delete" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger mx-2" style="height:34px;" name="delete">削除</button>
                        <input type="hidden" name="id" value="{{ $link->id }}">
                    </form>
                </div>   
            @empty
                <p class="p-3">作成したドキュメントはありません</p>
            @endforelse
            <form action="/mypage/partner/link_insert/{{ Auth::user()->id }}">
                @csrf
                <button class="btn btn-primary">新規のドキュメントを追加</button>
            </form>
        </div>
    </div>
@endsection
