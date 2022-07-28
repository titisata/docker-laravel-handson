@extends('mypage.layouts.app')

@section('menu', 'partner_profile')
@section('content')
<script>
    $(function(){
        $('textarea')
            .on('input', function(){
                if ($(this).outerHeight() > this.scrollHeight){
                    $(this).height(1)
                }
                while ($(this).outerHeight() < this.scrollHeight){
                    $(this).height($(this).height() + 1)
                }
            });
    });
</script>
<div class="container">
    <h1>予約状況</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">プロフィール情報</div>
                <div class="card-body">
                    <form action="/mypage/partner/profile" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">名前</label>
                            <input name="name" type="text" class="form-control" value="{{ $partner->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">キャッチコピー</label>
                            <input name="catch_copy" type="text" class="form-control" value="{{ $partner->catch_copy }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">住所</label>
                            <input name="address" type="text" class="form-control" value="{{ $partner->address }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">電話番号</label>
                            <input name="phone" type="text" class="form-control" value="{{ $partner->phone }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">説明</label>
                            <textarea name="description" type="text" class="form-control">{{ $partner->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">アクセス</label>
                            <textarea name="access" type="text" class="form-control">{{ $partner->access }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
