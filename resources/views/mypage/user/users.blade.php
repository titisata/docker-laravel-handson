@extends('mypage.layouts.app')

@section('menu', 'user_reserve')
@section('content')

<script>
    function CheckDelete(){
        if(window.confirm('登録ユーザを削除します。削除すると元に戻すことはできません。')){
            return true;
        }else{
            return false;
        }
    }
</script>

<div class="container">
    <div class="d-flex">
        <h1>ユーザ一覧</h1>
        <a href="/mypage/owner/users_edit" style="text-decoration: none; color: inherit;">
            <button class="btn btn-sm btn-success ms-5">新規作成</button>
        </a>
    </div>

    <div class="row justify-content-center">
        <table>
            <tr><th>ID</th><th>ユーザ名</th><th></th><th></th></tr>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                    <a href="/mypage/owner/users_edit/{{ $user->id }}" style="text-decoration: none; color: inherit;">
                        <button class="btn btn-sm btn-primary ms-5">編集</button>
                    </a>
                    </td>
                    <td>
                    @if($user->id <> 1)
                        <form action="/mypage/owner/users_edit" method="POST" onSubmit="return CheckDelete();">
                        @csrf
                        <a href="/mypage/owner/users_edit" style="text-decoration: none; color: inherit;">
                            <button type="submit" class="btn btn-sm btn-danger ms-5">削除</button>
                        </a>
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <input type="hidden" name="mode" value="del">
                        </form>
                    @endif
                    </td>
                </tr>
            @empty
            @endforelse
        </table>
    </div>
    
@endsection