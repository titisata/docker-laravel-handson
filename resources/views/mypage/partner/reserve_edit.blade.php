@extends('mypage.layouts.app')

@section('menu', 'owner_reserve_edit')
@section('content')
<div class="container">
    <h1>{{App\Consts\ReuseConst::EVENT}}予約編集</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
        <p class="text-danger">{{ session('result') }}</p>
            <div class="card mt-3">
                <div class="card-header">{{App\Consts\ReuseConst::EVENT}}予約編集</div>
                <div class="card-body">
                    <form action="/mypage/partner/reserve_edit/{{ $experiencereserve->id }}" method="POST">
                        @csrf
                       
                        <div class="mb-3">
                            <p>大人:{{ $experiencereserve->quantity_adult }}名</p>
                        </div>
                        <div class="mb-3">
                            <p>子ども:{{ $experiencereserve->quantity_child }}名</p>
                        </div>
                        <div class="mb-3">
                            <p>宿泊グループ：{{ $experiencereserve->hotelGroup?->name ?? 'なし' }}</p>
                        </div>
                        <div class="mb-3">
                            <p>食事グループ：{{ $experiencereserve->foodGroup?->name ?? 'なし' }}</p>
                        </div>
                        <div class="mb-3">
                            <p>連絡事項:{{ $experiencereserve->comment }}</p>
                        </div>
                        <div class="mb-3">
                            <p>予約日:{{ $experiencereserve->start_date }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ステータス</label>
                            <select name="save_flag" >
                                @if($user->hasRole('system_admin|site_admin'))
                                    @if($experiencereserve->hotel_group_id == '')
                                        @foreach(App\Consts\OrderConst::STATUS_LIST as $key =>$val)
                                        <option value="{{ $key }}" @if ($experiencereserve->status == $key ) selected @endif >{{$val}}</option>       
                                        @endforeach
                                    @else
                                        @foreach(App\Consts\OrderConst::LODGING_STATUS_LIST as $key =>$val)
                                        <option value="{{ $key }}" @if ($experiencereserve->status == $key ) selected @endif >{{$val}}</option>       
                                        @endforeach
                                    @endif
                                @elseif($user->hasRole('partner'))
                                    @if($experiencereserve->hotel_group_id == '')
                                        @foreach(App\Consts\OrderConst::PARTNER_STATUS_LIST as $key =>$val)
                                        <option value="{{ $key }}" @if ($experiencereserve->status == $key ) selected @endif >{{$val}}</option>       
                                        @endforeach
                                    @else
                                        @foreach(App\Consts\OrderConst::LODGING_PARTNER_STATUS_LIST as $key =>$val)
                                        <option value="{{ $key }}" @if ($experiencereserve->status == $key ) selected @endif >{{$val}}</option>       
                                        @endforeach
                                    @endif    
                                @endif
                            </select>
                        </div>
                        @if($user->hasRole('system_admin|site_admin'))
                            @if($experiencereserve->hotel_group_id != '')
                            <div class="mb-3">
                                
                                <label class="form-label">ホテル</label>
                                <select name="hotel_id">     
                                    <option value="">選択して下さい</option>                            
                                    @foreach($hotels as $hotel)
                                        @if("{{ $experiencereserve->hotel_id }}" == "{{ $hotel->id }}")
                                            <option value="{{ $hotel->id }}" selected>{{ $hotel->name }}</option>
                                        @else
                                            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                        @endif   
                                    @endforeach
                                </select>                  
                            </div> 
                            @endif
                        @endif
                        <input type="hidden" name="id" value="{{ $experiencereserve->id }}">

                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                    
            
                </div>
            </div>  
        </div>
    </div>
    
</div>
@endsection
