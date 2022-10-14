@extends('mypage.layouts.app')

@section('menu', 'category')
@section('content')

<style>
    .number_form{
        width:60px;
    }
</style>
<div class="container">
    <h1>カテゴリー編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-12 d-xl-flex">
            <div class="col card mt-3 me-xl-3">
                <div class="card-header fs-3">体験カテゴリー編集</div>
                <div class="card-body">
                    <form action="/mypage/owner/action_experience_category_display" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">新しい体験カテゴリー名</label>
                            <div class="d-flex" style="width:300px">
                                <input name="name" type="text" class="form-control" placeholder="追加したいカテゴリー名を入力してください" value="">
                                <button type="submit" class="btn btn-primary">追加</button>
                            </div>
                        </div>                     
                    </form>

                    <p>現在表示されている体験カテゴリー</p>
                    <div class="d-flex flex-column">
                    @foreach ($experience_categories as $experience_category)
                    <div class='d-flex my-2 align-items-center'>
                        <form action="/mypage/owner/action_experience_category_update" method="POST">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="name" class="form-control form-control-sm" value="{{ $experience_category->name }}">
                                <button type="submit" class="btn btn-sm btn-primary mx-2" name="update">更新</button>
                                <input type="hidden" name="id" value="{{ $experience_category->id }}">
                            </div>
                           
                        </form>
                        
                        <form action="/mypage/owner/action_experience_category_delete" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger mx-2" style="height:34px;" name="delete">削除</button>
                            <input type="hidden" name="id" value="{{ $experience_category->id }}">
                        </form>

                        
                    
                        @forelse($experience_category->images() as $image)
                        <div class="d-flex flex-column col-4 my-3 ms-3">
                            <label>{{ $experience_category->name }}カテゴリーの設定画像</label>
                            <img class="card-img" style="width: 140px;height: 100px; object-fit: cover;" src="{{ $image->image_path }}" alt=""> 
                            <div class="d-flex">
                                <a href="/mypage/owner/experience_category_image_update/{{ $image->id }}">
                                    <div class="btn btn-primary">画像編集</div>
                                </a>    
                                <a href="/mypage/owner/experience_category_image_delete/{{ $image->id }}">
                                    <div class="btn btn-danger">画像削除</div>
                                </a>                             
                            </div>                         
                            
                        </div>        
                        
                        @empty
                        <div class="d-flex ms-3 my-3">
                            <label>{{ $experience_category->name }}カテゴリーの設定画像</label>
                            <a href="/mypage/owner/experience_category_image_insert/{{ $experience_category->id }}">
                                <div class="btn btn-success">
                                    画像登録     
                                </div>
                            </a>
                        </div>
                            
                            
                        @endforelse
                    
                        
                    </div> 
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="col card mt-3 ms-xl-3">
                <div class="card-header fs-3">{{App\Consts\ReuseConst::GOODS}}カテゴリー編集</div>
                <div class="card-body">
                    <form action="/mypage/owner/action_goods_category_insert" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">新しい{{App\Consts\ReuseConst::GOODS}}カテゴリー名</label>
                            <div class="d-flex" style="width:300px">
                                <input name="name" type="text" class="form-control" placeholder="追加したいカテゴリー名を入力してください" value="">
                                <button type="submit" class="btn btn-primary">追加</button>
                            </div>
                            
                        </div>  
                    </form>

                    <p>現在表示されている{{App\Consts\ReuseConst::GOODS}}カテゴリー</p>
                    <div class="d-flex flex-column">
                    @foreach ($goods_categories as $goods_category)
                    <div class='d-flex my-2 align-items-center'>
                        <form action="/mypage/owner/action_goods_category_update" method="POST">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="name" class="form-control form-control-sm" value="{{ $goods_category->name }}">
                                <button type="submit" class="btn btn-sm btn-primary mx-2" name="update">更新</button>
                                <input type="hidden" name="id" value="{{ $goods_category->id }}">
                            </div>
                            
                        </form>
                        
                        <form action="/mypage/owner/action_goods_category_delete" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger mx-2" style="height:34px;" name="delete">削除</button>
                            <input type="hidden" name="id" value="{{ $goods_category->id }}">
                        </form>
    
                    
                    
                        @forelse($goods_category->images() as $image)
                        <div class="d-flex flex-column col-4 my-3">
                            <label>{{ $goods_category->name }}カテゴリーの設定画像</label>
                            <img class="card-img" style="width: 200px;height: 140px; object-fit: cover;" src="{{ $image->image_path }}" alt=""> 
                            <div class="d-flex">
                                <a href="/mypage/owner/goods_category_image_update/{{ $image->id }}">
                                    <div class="btn btn-primary">画像編集</div>
                                </a>    
                                <a href="/mypage/owner/goods_category_image_delete/{{ $image->id }}">
                                    <div class="btn btn-danger">画像削除</div>
                                </a>                             
                            </div>                         
                            
                        </div>        
                        
                        @empty
                            <div class="d-flex ms-3 my-3">
                                <label>{{ $goods_category->name }}カテゴリーの設定画像</label>
                                <a href="/mypage/owner/goods_category_image_insert/{{ $goods_category->id }}">
                                    <div class="btn btn-success">
                                        画像登録     
                                    </div>
                                </a>
                            </div>
                        @endforelse
                    
                        
                    </div> 
                    @endforeach
                    </div>
                    
                
            </div>
        </div>
    </div>
</div>

@endsection