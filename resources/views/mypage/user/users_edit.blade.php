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

                        <div class="form-group row mb-3">
                            <label for="postal_code" class="">郵便番号</label>

                            <div class="">
                                <input id="postal_code" type="text" class="form-control p-postal-code @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ @$user->postal_code }}" autocomplete="postal_code" placeholder="000-0000">

                                @error('postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="pref" class="">都道府県</label>

                            <div class="">
                                <select name="pref_id" id="pref_id" class="form-control p-region @error('pref_id') is-invalid @enderror">
                                    <option value="">-- 選択してください --</option>
                                    @foreach (App\Models\User::$prefs as $key => $pref)
                                    <option value="{{ $key }}" @if (@$user->pref_id == $key) selected @endif>    
                                        {{ $pref }}
                                    </option>
                                    @endforeach
                                </select>

                                @error('pref_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="city" class="">市区町村</label>

                            <div class="">
                                <input id="city" type="text" class="form-control p-locality @error('city') is-invalid @enderror" name="city" value="{{ @$user->city }}" autocomplete="city" placeholder="大阪市北区">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="town" class="">町内番地等</label>

                            <div class="">
                                <input id="town" type="text" class="form-control p-street-address @error('town') is-invalid @enderror" name="town" value="{{ @$user->town }}" autocomplete="town" placeholder="中之島1丁目1-1">

                                @error('town')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="building" class="">建物等</label>

                            <div class="">
                                <input id="building" type="text" class="form-control @error('bilding') is-invalid @enderror" name="building" value="{{ @$user->building }}" autocomplete="building" placeholder="中之島○○ビル101号室">

                                @error('building')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="phone_number" class="">電話番号</label>

                            <div class="">
                                <input id="phone number" type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ @$user->phone_number }}" autocomplete="phone_number" placeholder="06-0000-0000">

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
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