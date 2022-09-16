@extends('mypage.layouts.app')

@section('menu', 'partner_event')
@section('content')
<div class="container">
    <h1>イベント削除</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/mypage/owner/action_experience_delete/{{ $experience->id }}" method="POST">
                @csrf

                <div class="card mt-3">
                    <div class="card-header">時間帯設定</div>
                    <div class="card-body">
                        <div class="card mt-3 p-3 ex_data">
                            <input hidden name="ex_ids" type="hidden" value="{{ $experience->id }}">
                            <input hidden name="ex_folder_ids" type="hidden" value="{{ $experience->experience_folder_id }}">
                            <div class="mb-3">
                                <label class="form-label">名前</label>
                                <input name="ex_names[]" type="text" class="form-control" value="{{ $experience->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">大人料金</label>
                                <input name="ex_price_adults[]" type="number" class="form-control" value="{{ $experience->price_adult }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">子供料金</label>
                                <input name="ex_price_childs[]" type="number" class="form-control" value="{{ $experience->price_child }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ソートナンバー</label>
                                <input name="ex_sort_nos[]" type="number" class="form-control" value="{{ $experience->sort_no}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">上限人数</label>
                                <input name="ex_quantities[]" type="number" class="form-control" value="{{ $experience->quantity }}">
                            </div>
                            
                        </div>
                    </div>
                </div>
                <button type="submit" class="mt-2 btn btn-danger">削除</button>
            </form>
        </div>
    </div>
</div>
@endsection
