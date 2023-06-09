@extends('mypage.layouts.app')

@section('menu', 'partner_display')
@section('content')
<div class="container">
    <div class="d-flex">
        <h1>出展者一覧</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="row justify-content-center">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">出展者名</th>
                            <th scope="col">設定画像</th>
                        </tr>
                    </thead>
                    @forelse ($partners as $partner)
                        <tr class="align-items-center">
                            <td>
                                <a class="link" href="/mypage/owner/partner_manege/{{ $partner->id }}">
                                    {{ $partner->name }}様
                                </a>  
                            </td>
                            <td>
                                @forelse($partner->images() as $image)
                                    <img class="card-img" style="width: 100px;height: 50px; object-fit: cover;" src="{{ $image->image_path }}" alt="">
                                @empty
                                    <p>未設定</p>
                                @endforelse
                            </td> 
                            
                        </tr>   
                    @empty
                        <p>パートナーがいません</p>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
