@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">プロフィール</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>名前: {{ $user->name }}</p>
                    <p>メールアドレス: {{ $user->email }}</p>
                </div>
            </div>

            {{-- パートナーのみ表示する: ここから --}}
            @if(isset( $partner ))
                <div class="card mt-2">
                    <div class="card-header">パートナー情報</div>

                    <div class="card-body">
                        <p>あなたはパートナーです</p>
                        <a href="/partner/{{ $partner->id }}">パートナー詳細画面へ</a>
                    </div>
                </div>
            @endif
            {{-- パートナーのみ表示する: ここまで --}}

        </div>
    </div>
</div>
@endsection
