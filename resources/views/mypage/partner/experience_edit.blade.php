@extends('mypage.layouts.app')

@section('menu', 'partner_event')
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
    <h1>イベント編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">イベント情報</div>
                <div class="card-body">
                    <form action="{{ request()->fullUrl() }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">名前</label>
                            <input name="name" type="text" class="form-control" value="{{ $experiences_folder->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">大人料金</label>
                            <input name="price_adult" type="number" class="form-control" value="{{ $experiences_folder->price_adult }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">子供料金</label>
                            <input name="price_child" type="number" class="form-control" value="{{ $experiences_folder->price_child }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">説明</label>
                            <textarea name="description" type="text" class="form-control">{{ $experiences_folder->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">注意事項</label>
                            <textarea name="caution" type="text" class="form-control">{{ $experiences_folder->caution }}</textarea>
                        </div>
                        <div class="mb-3">
                        <label class="form-label">カテゴリ</label>
                        <select name="category" class="form-select mt-2" style="width:216px">
                            @foreach ($categories as $category)
                                <option @if ($experiences_folder->category == $category->name) selected @endif value="{{ $category->name }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        </div>
                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
