@extends('mypage.layouts.app')

@section('menu', 'reserved_user')
@section('content')
<div class="container">
<h1>過去に予約のあったユーザー</h1>
    <div class="row justify-content-center">
        <div class="">
        
            <div class="row justify-content-center">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            
                            <th>ユーザ名</th>
                            <th>メールアドレス</th>
                            <th>電話番号</th>
                            
                        </tr>
                    </thead>
                    
                    @forelse ( $reserved_users as $reserved_user )
                        <tr>
                            <td>
                                {{ $reserved_user->user->name }}
                            </td>
                            <td>
                                <p>{{ $reserved_user->user->email }}</p>
                            </td>
                            <td>
                                <p>{{ $reserved_user->user->phone_number }}</p>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
