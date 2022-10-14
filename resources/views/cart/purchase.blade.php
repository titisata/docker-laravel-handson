@extends('layouts.app')

@section('content')
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<script src="https://js.stripe.com/v3/"></script>
<style>.container-fluid{background-color: rgb(13 110 253 / 35%)}.heading{font-size: 40px;margin-top: 35px;margin-bottom: 30px;padding-left: 20px}.card{border-radius: 10px !important;margin-top: 60px;margin-bottom: 60px}.form-card{margin-left: 20px;margin-right: 20px}.form-card input, .form-card textarea{padding: 10px 15px 5px 15px;border: none;border: 1px solid lightgrey;border-radius: 6px;margin-bottom: 25px;margin-top: 2px;width: 100%;box-sizing: border-box;font-family: arial;color: #2C3E50;font-size: 14px;letter-spacing: 1px}.form-card input:focus, .form-card textarea:focus{-moz-box-shadow: 0px 0px 0px 1.5px skyblue !important;-webkit-box-shadow: 0px 0px 0px 1.5px skyblue !important;box-shadow: 0px 0px 0px 1.5px skyblue !important;font-weight: bold;border: 1px solid #304FFE;outline-width: 0}.input-group{position:relative;width:100%;overflow:hidden}.input-group input{position:relative;height:80px;margin-left: 1px;margin-right: 1px;border-radius:6px;padding-top: 30px;padding-left: 25px}.input-group label{position:absolute;height: 24px;background: none;border-radius: 6px;line-height: 48px;font-size: 15px;color: gray;width:100%;font-weight:100;padding-left: 25px}input:focus + label{color: #304FFE}.btn-pay{background-color: #304FFE;height: 40px;width: 100%;color: #ffffff !important;font-weight: bold}.btn-pay:hover{background-color: #3F51B5}.fit-image{width: 100%;object-fit: cover}img{border-radius: 5px}.radio-group{position: relative;margin-bottom: 25px}.radio{display:inline-block;border-radius: 6px;box-sizing: border-box;border: 2px solid lightgrey;cursor:pointer;margin: 12px 25px 12px 0px}.radio:hover{box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.2)}.radio.selected{box-shadow: 0px 0px 0px 1px rgba(0, 0, 155, 0.4);border: 2px solid blue}.label-radio{font-weight: bold;color: #000000}</style>

<div class="container">
    <div class="row justify-content-center"> 
        <form class="col-md-8" action="{{ Request::url() }}" method="POST" id="card-form" class="form-card">
        @csrf
        <h3 class="my-3">お支払方法の決定</h3>

        <div class="container-fluid p-3 shadow-sm">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-9 p-0">
                    <div class="card p-3 shadow-sm mb-0">
                        <div class="row justify-content-center">
                            <div class="col-12 border-bottom py-2">
                                <h3 class="text-center">ご請求額：￥<span class="fw-bold">{{ number_format($price) }}</span></h3>
                            </div>
                        </div>
                        
                        <fieldset>
                            <div style="margin-bottom:15px;" class="pt-2">
                                <label class="fs-5" for="card_number">カード番号</label>
                                <div id="card_number"></div>
                            </div>

                            <div style="margin-bottom:15px;">
                                <label class="fs-5" for="card_expiry">有効期限</label>
                                <div id="card_expiry"></div>
                                <input type="hidden" name="cardExpMonth" data-stripe="exp_month">
                                <input type="hidden" name="cardExpYear" data-stripe="exp_year">
                            </div>

                            <div style="margin-bottom:15px;">
                                <label class="fs-5" for="card-cvc">セキュリティコード</label>
                                <div id="card-cvc"></div>
                            </div>

                            <div>
                                <div id="card-errors"></div>
                            </div>
                        </fieldset>  
                        <input type="hidden" name="price" value="{{ $price }}">

                        <div class="row justify-content-center" style="margin-top:20px;margin-bottom:20px;">
                            <div class="col-md-8">
                                <button class="btn btn-pay placeicon">購入を確定する</button>
                            </div>
                        </div>
                    </div>
                </div>
            
                @if($goods_check == 1)
                <div class="mt-4 p-0 card mx-4 col-lg-9 col-md-9 mb-0">
                    <div class="card-header p-0">
                        <p class="fs-5 mt-3 text-center">商品のお届け先確認<br>（購入する商品のお届け先変更できます）</p> 
                    </div>
                    <label for="" class="px-3 pt-3">
                        お届け先氏名
                        <input name="to_name" class="form-control" type="text" value="{{ $name }}">
                    </label>
                    <label for=""class="px-3">
                        お届け先郵便番号
                        <input name="to_postal_code" class="form-control" type="text" value="{{ $postal_code }}">
                    </label>
                    <label for=""class="px-3">
                        お届け先都道府県
                        <select name="to_pref_id" id="pref_id" class="form-control p-region @error('pref_id') is-invalid @enderror">
                            <option value="">-- 選択してください --</option>
                                @foreach (App\Models\User::$prefs as $key => $pref)
                                    <option value="{{ $key }}" @if ($pref_id == $key) selected @endif>{{ $pref }}</option>
                                @endforeach
                        </select>
                    </label>
                    <label for=""class="px-3">
                        お届け先市区町村
                        <input name="to_city" class="form-control" type="text" value="{{ $city }}">
                    </label>
                    <label for=""class="px-3">
                        お届け先町名番地等
                        <input name="to_town" class="form-control" type="text" value="{{ $town }}">
                    </label>
                    <label for=""class="px-3">
                        お届け先建物名等
                        <input name="to_building" class="form-control" type="text" value="{{ $building }}">
                    </label>
                    <label for=""class="px-3 pb-3">
                        お届け先電話番号
                        <input name="to_phone_number" class="form-control" type="text" value="{{ $phone_number }}">
                    </label>
                </div>
                @endif
                
            </div>

            
            @forelse($goodCartItems as $goodCartItem)
                @if($loop->first)
                <div class="my-4 border p-3 shadow-sm">
                    <h4>{{App\Consts\ReuseConst::GOODS}}</h4>
                @endif
                <div class="mt-1 p-2 card mb-1">
                    <div>
                        <div class="d-flex justify-content-between mt-2 border-bottom">
                            
                            <p>商品名: {{ $goodCartItem->goods->name }}</p>
                            
                        </div>
                        <p class="mt-2">商品数: {{ $goodCartItem->quantity }}個</p>
                        <p class="fs-5 text-end">合計金額: <span class="small_font fw-normal me-1">送料・税込</span><span class="fw-bold ">{{ number_format($goodCartItem->sum_price()) }}</span>円</p>     
                    </div>
                    
                </div>
                @if($loop->last)
                </div>
                @endif
            @empty
            @endforelse
            
           
            
            @forelse($experienceCartItems as $experienceCartItem)
                @if($loop->first)
                <div class="border p-3 shadow-sm my-4">
                    <h4>体験</h4>
                @endif
                <div class="p-2 card mb-1 mt-1">
                    
                    <div>
                        <div class="d-flex justify-content-between mt-2 border-bottom">
                            <p>{{ App\Models\ExperienceFolder::where('id',$experienceCartItem->experience->experience_folder_id)->first()->name }}　　{{ $experienceCartItem->experience->name }}</p>
                        </div>
                        <div class="d-flex mt-2">
                            <p class="me-3">体験日: {{ $experienceCartItem->start_date }}</p>
                            <p>大人: {{ $experienceCartItem->quantity_adult }}人 子ども: {{ $experienceCartItem->quantity_child }}人</p>
                        </div>
                        <div class="d-flex">
                            <p class="me-3">宿泊: {{ $experienceCartItem->hotelGroup?->name ?? 'なし' }}</p>
                            <p>食事: {{ $experienceCartItem->foodGroup?->name ?? 'なし' }}</p>
                        </div>
                        <p>連絡事項: {{ $experienceCartItem->message ?? 'なし'}}</p>
                        <p class="fs-5 text-end">金額: <span class="small_font fw-normal">税込</span><span class="fw-bold">{{ number_format($experienceCartItem->sum_price()) }}</span>円</p>
                        
                    </div>
                </div>  
                @if($loop->last)
                </div>
                @endif
            @empty
                
            @endforelse

            


            
                
            </div>
        </form>
    </div>
</div>

<script>
    var stripe = Stripe('{{ $stripe_public_key }}');
    var elements = stripe.elements();

    var style = {
        base: {
            fontSize: '16px',
            color: "#32325d",
        }
    };

    const elementStyles = {
        base: {
          color: '#32325D',
          fontWeight: 500,
          fontFamily: 'Source Code Pro, Consolas, Menlo, monospace',
          fontSize: '1.2em',
          fontSmoothing: 'antialiased',
          '::placeholder': {
            color: '#CFD7DF'
          },
          ':-webkit-autofill': {
            color: '#e39f48'
          },
          backgroundColor: '#F5F7F7',
          fontSize: '16px',
          lineHeight: '35px',
          padding: '16px'
        },
        invalid: {
          color: '#E25950',
          '::placeholder': {
            color: '#FFCCA5'
          }
        }
      };
      const elementClasses = {
        focus: 'focused',
        empty: 'empty',
        invalid: 'invalid'
      };
      
    // クレジットカード情報入力欄の構築
    var cardNumber = elements.create('cardNumber', {
        style: elementStyles,
        classes: elementClasses
    });
    cardNumber.mount('#card_number');

    cardNumber.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var cardExpiry = elements.create('cardExpiry', {
        style: elementStyles,
        classes: elementClasses
    });
    cardExpiry.mount('#card_expiry');

    cardExpiry.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var cardCvc = elements.create('cardCvc', {
        style: elementStyles,
        classes: elementClasses
    });
    cardCvc.mount('#card-cvc');

    cardCvc.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('card-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        var errorElement = document.getElementById('card-errors');
        if (event.error) {
            errorElement.textContent = event.error.message;
        } else {
            errorElement.textContent = '';
        }

        stripe.createToken(cardNumber).then(function(result) {
            if (result.error) {
                errorElement.textContent = result.error.message;
            } else {
                stripeSubmit(result.token);
            }
        });
    });

    function stripeSubmit(token) {
        var form = document.getElementById('card-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
    }
</script>

@endsection
