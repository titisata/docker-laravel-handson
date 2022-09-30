@extends('mypage.layouts.app')

@section('menu', 'owner_reserve_edit')
@section('content')
<div class="container">
    <h1>イベント予約編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
        <p class="text-danger">{{ session('result') }}</p>
            <div class="card mt-3">
                <div class="card-header">イベント予約編集</div>
                <div class="card-body">
                    <form action="/mypage/owner/reserve_edit/{{ $experiencereserve->id }}" method="POST">
                        @csrf
                       
                        <div class="mb-3">
                            <p>大人:{{ $experiencereserve->quantity_adult }}名</p>
                        </div>
                        <div class="mb-3">
                            <p>子ども:{{ $experiencereserve->quantity_child }}名</p>
                        </div>
                        <div class="mb-3">
                            <!-- <label class="form-label">宿泊</label>
                            <input name="hotel_group" type="text" class="form-control" value="{{ $experiencereserve->hotelGroup?->name ?? 'なし' }}"> -->
                            <p>宿泊グループ：{{ $experiencereserve->hotelGroup?->name ?? 'なし' }}</p>
                        </div>
                        <div class="mb-3">
                            <!-- <label class="form-label">食事</label>
                            <input name="food_group" type="text" class="form-control" value="{{ $experiencereserve->foodGroup?->name ?? 'なし' }}"> -->
                            <p>食事グループ：{{ $experiencereserve->foodGroup?->name ?? 'なし' }}</p>
                        </div>
                        <div class="mb-3">
                            <!-- <label class="form-label">連絡事項</label>
                            <input name="comment" type="text" class="form-control" value="{{ $experiencereserve->comment }}"> -->
                            <p>連絡事項:{{ $experiencereserve->comment }}</p>
                        </div>
                        <div class="mb-3">
                            <!-- <label class="form-label">予約日</label>
                            <input name="status" type="text" class="form-control" value="{{ $experiencereserve->start_date }}"> -->
                            <p>予約日:{{ $experiencereserve->start_date }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ステータス</label>
                            <input name="status" type="text" class="form-control" value="{{ $experiencereserve->status }}">
                        </div>  
                        <div class="mb-3">
                            
                            <label class="form-label">ホテル</label>
                            <select name="hotel_id" id="">     
                                <option value="0">選択して下さい</option>                            
                                @foreach($hotels as $hotel)
                                    @if("{{ $experiencereserve->hotel_id }}" == "{{ $hotel->id }}")
                                        <option value="{{ $hotel->id }}" selected>{{ $hotel->name }}</option>
                                    @else
                                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                    @endif   
                                @endforeach
                            </select>                  
                        </div>  
                        <div>
                            <label for="">確認メール送信</label>
                            <div class="d-flex flex-column">
                                <div>
                                    <input id="n_mail" name="mail" type="radio" value="0" checked>
                                    <label for="n_mail" class="fw-normal">メール送信しない</label>
                                </div>
                                <div>
                                    <input id="f_mail" name="mail" type="radio" value="1">
                                    <label for="f_mail" class="fw-normal">ホテル確定メール送信</label>
                                </div>
                                <div>
                                    <input id="s_mail" name="mail" type="radio" value="2">
                                    <label for="s_mail" class="fw-normal">予約ステータス変更メール送信</label>
                                </div>
                                
                            </div> 
                        </div>
                        

                    <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                    <!-- <div class="mt-3">
                        <form action="" >
                            <input type="hidden" name="" value="{{ $experiencereserve->quantity_adult }}">
                            <input type="hidden" name="" value="{{ $experiencereserve->quantity_child }}">
                            <input type="hidden" name="" value="">
                            <input type="hidden" name="" value="">
                            <input type="hidden" name="" value="">
                            <input type="hidden" name="" value="">
                            <button type="submit" class="btn btn-success">確認メール送信</button>
                        </form>
                    </div> -->
                    
            
                </div>
            </div>  
        </div>
    </div>
    
</div>
@endsection
