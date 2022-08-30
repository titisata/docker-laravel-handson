@extends('mypage.layouts.app')

@section('menu', 'owner_reserve_edit')
@section('content')
<div class="container">
    <h1>イベント予約編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card mt-3">
                <div class="card-header">イベント予約編集</div>
                <div class="card-body">
                    <form action="/mypage/owner/reserve_edit/{{ $experiencereserve->id }}" method="POST">
                        @csrf
                       
                        <div class="mb-3">
                            <label class="form-label">大人</label>
                            <input name="quentity_child" type="text" class="form-control" value="{{ $experiencereserve->quantity_adult }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">子供</label>
                            <input name="quentity_child" type="text" class="form-control" value="{{ $experiencereserve->quantity_child }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">宿泊</label>
                            <input name="quentity_child" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">食事</label>
                            <input name="quentity_child" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">連絡事項</label>
                            <input name="comment" type="text" class="form-control" value="{{ $experiencereserve->comment }}">
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
                    <button type="submit" class="btn btn-primary">更新</button>
                    </form>
            
                </div>
            </div>  
        </div>
    </div>
    
</div>
@endsection
