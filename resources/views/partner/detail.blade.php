@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">パートナー詳細ページ</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>名前: {{ $partner->name }}</p>
                    <p>住所: {{ $partner->address }}</p>
                    <p>電話番号: {{ $partner->phone }}</p>
                    <p>キャッチコピー: {{ $partner->catch_copy }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
