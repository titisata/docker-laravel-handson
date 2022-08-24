
<form action="/test" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">サイトの名前</label>
        <input name="name" type="text" class="form-control" value="">
        <label class="form-label">コメント</label>
        <input name="comment" type="text" class="form-control" value="">
        <button type="submit">更新</button>
    </div>
</form>                        