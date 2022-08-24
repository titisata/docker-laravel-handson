<form action="/test/delete" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">サイトの名前</label>
        <input name="name" type="text" class="form-control" value="{{ $tests->name }}">
        <label class="form-label">コメント</label>
        <input name="comment" type="text" class="form-control" value="{{ $tests->comment }}">
        <button type="submit">削除</button>
    </div>
    <input type="hidden" name="id" value="{{ $tests->id }}">
</form>   