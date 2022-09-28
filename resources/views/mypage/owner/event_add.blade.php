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
    <h1>イベント新規作成</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/mypage/owner/action_event_add" method="POST">
                @csrf
                <div class="card mt-3">
                <input name="user_id" type="hidden" value="{{ $user->id }}">
                <input name="status" type="hidden" value="1" >
                    <div class="card-header">基本情報</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">名前</label>
                            <input name="name" type="text" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">大人料金</label>
                            <input name="price_adult" type="number" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">子供料金</label>
                            <input name="price_child" type="number" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">住所</label>
                            <input name="address" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">連絡先電話番号<span class="small text-danger">この体験に関する電話連絡（キャンセルやお問合せ等）の受付先を入力してください</span></label>
                            <textarea name="phone" type="text" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">説明</label>
                            <textarea name="description" type="text" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">イベント詳細</label>
                            <textarea name="detail" type="text" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">注意事項</label>
                            <textarea name="caution" type="text" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">宿泊の有無</label>
                            <input name="is_lodging" type="radio" class="" checked  value="1">
                            <label>宿泊あり</label>
                            <input name="is_lodging" type="radio" class="" value="0">
                            <label>宿泊なし</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">宿泊の場合の前泊・後泊</label>
                            <input name="is_before_lodging" type="radio" class="" checked  value="0">
                            <label>後泊</label>
                            <input name="is_before_lodging" type="radio" class="" value="1">
                            <label>前泊</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">おすすめフラグ</label>
                            <input name="recommend_flag" type="radio" class="" checked  value="1">
                            <label>おすすめする</label>
                            <input name="recommend_flag" type="radio" class="" value="0">
                            <label>おすすめしない</label>
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
                    </div>
                </div>

                
                <button type="submit" class="mt-2 btn btn-primary">作成</button>
            </form>
        </div>
    </div>
</div>
@endsection
