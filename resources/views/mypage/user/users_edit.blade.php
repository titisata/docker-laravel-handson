@extends('mypage.layouts.app')

@section('menu', 'user_reserve')
@section('content')

<script>
    function InputCheck(){
        var email = document.getElementById('email').value;
        var input1 = document.getElementById('pass').value;
		var input2 = document.getElementById('cpass').value;
        
        if (!email.match(/.+@.+\..+/)) {
            alert("メールアドレスが正しくありません。");
            return false;
        }

        if(input1 != input2){
			alert("パスワードが一致しません。");
            return false;
		}else{
            return true;
		}
    }
</script>

<div class="container">
    <h1>ユーザ管理</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card mt-3">
                <div class="card-header">ユーザ情報</div>
                <div class="card-body">
                    <form action="/mypage/owner/users_edit" method="POST" onSubmit="return InputCheck();">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">ユーザ名</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{ @$user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">メールアドレス</label>
                            <input id="email" name="email" type="text" class="form-control" value="{{ @$user->email }}" required>
                        </div>

                        @if (isset( $user->id ))
                            <div class="mb-3">
                                <label class="form-label">パスワード</label>
                                <input id="pass" name="pass" type="password" class="form-control" value="">
                            </div>
                        @else
                            <div class="mb-3">
                                <label class="form-label">パスワード</label>
                                <input id="pass" name="pass" type="password" class="form-control" value="" required>
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <label class="form-label">パスワード確認</label>
                            <input id="cpass" name="cpass" type="password" class="form-control" value="">
                        </div>

                        @if (isset( $user->id ))
                            <div class="mb-3" style="display:none;">
                                <label class="form-label">ロール</label>
                                <select name="role[]" class="form-control" multiple required>
                                    @forelse ($roles as $role)
                                        @if (in_array($role->name, $user_roles))
                                            <option value='{{ @$role->name }}' selected>{{ @$role->name }}</option>
                                        @else
                                            <option value='{{ @$role->name }}'>{{ @$role->name }}</option>
                                        @endif
                                    @empty
                                        <option value=''>データがありません</option>
                                    @endforelse
                                </select>
                            </div>
                        @else
                            <div class="mb-3">
                                <label class="form-label">ロール</label>
                                <select name="role[]" class="form-control" multiple required>
                                    @forelse ($roles as $role)
                                        @if (in_array($role->name, $user_roles))
                                            <option value='{{ @$role->name }}' selected>{{ @$role->name }}</option>
                                        @else
                                            <option value='{{ @$role->name }}'>{{ @$role->name }}</option>
                                        @endif
                                    @empty
                                        <option value=''>データがありません</option>
                                    @endforelse
                                </select>
                            </div>
                        @endif

                        @if (isset( $user->id ))
                            <input type="hidden" name="mode" value="upd">
                        @else
                            <input type="hidden" name="mode" value="ins">
                        @endif
                        <input type="hidden" name="id" value="{{ @$user->id }}">
                        <button type="submit" class="btn btn-primary">登録</button>
                        <button type="button" class="btn btn-danger"><a href="/mypage/owner/users">ｷｬﾝｾﾙ</a></button>
                    </form>
                </div>
            </div>  
        </div>
    </div>
</div>
@endsection