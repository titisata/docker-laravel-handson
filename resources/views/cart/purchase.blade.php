@extends('layouts.app')

@section('content')
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<script src="https://js.stripe.com/v3/"></script>
<style>.container-fluid{background-color: #C5CAE9}.heading{font-size: 40px;margin-top: 35px;margin-bottom: 30px;padding-left: 20px}.card{border-radius: 10px !important;margin-top: 60px;margin-bottom: 60px}.form-card{margin-left: 20px;margin-right: 20px}.form-card input, .form-card textarea{padding: 10px 15px 5px 15px;border: none;border: 1px solid lightgrey;border-radius: 6px;margin-bottom: 25px;margin-top: 2px;width: 100%;box-sizing: border-box;font-family: arial;color: #2C3E50;font-size: 14px;letter-spacing: 1px}.form-card input:focus, .form-card textarea:focus{-moz-box-shadow: 0px 0px 0px 1.5px skyblue !important;-webkit-box-shadow: 0px 0px 0px 1.5px skyblue !important;box-shadow: 0px 0px 0px 1.5px skyblue !important;font-weight: bold;border: 1px solid #304FFE;outline-width: 0}.input-group{position:relative;width:100%;overflow:hidden}.input-group input{position:relative;height:80px;margin-left: 1px;margin-right: 1px;border-radius:6px;padding-top: 30px;padding-left: 25px}.input-group label{position:absolute;height: 24px;background: none;border-radius: 6px;line-height: 48px;font-size: 15px;color: gray;width:100%;font-weight:100;padding-left: 25px}input:focus + label{color: #304FFE}.btn-pay{background-color: #304FFE;height: 40px;width: 100%;color: #ffffff !important;font-weight: bold}.btn-pay:hover{background-color: #3F51B5}.fit-image{width: 100%;object-fit: cover}img{border-radius: 5px}.radio-group{position: relative;margin-bottom: 25px}.radio{display:inline-block;border-radius: 6px;box-sizing: border-box;border: 2px solid lightgrey;cursor:pointer;margin: 12px 25px 12px 0px}.radio:hover{box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.2)}.radio.selected{box-shadow: 0px 0px 0px 1px rgba(0, 0, 155, 0.4);border: 2px solid blue}.label-radio{font-weight: bold;color: #000000}</style>

<div class="container">
    <div class="row justify-content-center"> 
        <form class="col-md-8" action="{{ Request::url() }}" method="POST" id="card-form" class="form-card">
        @csrf
            <div class="d-flex align-items-center mt-3">

                <h3 class="mb-3">お支払方法の決定</h3>

                <button type="button" class="btn btn-outline-secondary mb-3 ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    送り先変更
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{App\Consts\ReuseConst::GOODS}}のお送り先</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mt-2">
                                    <p>送り先が{{ Auth::user()->name }}さんの住所と異なる場合下記のフォームを変更してください</p> 
                                    <div class="mt-1 p-3 card">
                                        <label for="">
                                            送り先氏名
                                            <input name="to_name" class="form-control" type="text" value="{{ $name }}">
                                        </label>
                                        <label for="">
                                            送り先郵便番号
                                            <input name="to_postal_code" class="form-control" type="text" value="{{ $postal_code }}">
                                        </label>
                                        <label for="">
                                            送り先都道府県
                                            <select name="to_pref_id" id="pref_id" class="form-control p-region @error('pref_id') is-invalid @enderror">
                                                <option value="">-- 選択してください --</option>
                                                    @foreach (App\Models\User::$prefs as $key => $pref)
                                                        <option value="{{ $key }}" @if ($pref_id == $key) selected @endif>{{ $pref }}</option>
                                                    @endforeach
                                            </select>
                                        </label>
                                        <label for="">
                                            送り先市区町村
                                            <input name="to_city" class="form-control" type="text" value="{{ $city }}">
                                        </label>
                                        <label for="">
                                            送り先町名番地等
                                            <input name="to_town" class="form-control" type="text" value="{{ $town }}">
                                        </label>
                                        <label for="">
                                            送り先建物名等
                                            <input name="to_building" class="form-control" type="text" value="{{ $building }}">
                                        </label>
                                        <label for="">
                                            送り先電話番号
                                            <input name="to_phone_number" class="form-control" type="text" value="{{ $phone_number }}">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">変更</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class=" col-lg-6 col-md-8">
                        <div class="card p-3">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <h2 class="heading text-center">￥{{ number_format($price) }}</h2>
                                </div>
                            </div>
                            
                            <!--<div class="row justify-content-center mb-4 radio-group">
                                <div class="col-sm-3 col-5">
                                    <div class='radio selected mx-auto' data-value="dk"> <img class="fit-image" src="https://i.imgur.com/5TqiRQV.jpg" width="105px" height="55px"> </div>
                                </div>
                                <div class="col-sm-3 col-5">
                                    <div class='radio mx-auto' data-value="visa"> <img class="fit-image" src="https://i.imgur.com/OdxcctP.jpg" width="105px" height="55px"> </div>
                                </div>
                                <div class="col-sm-3 col-5">
                                    <div class='radio mx-auto' data-value="master"> <img class="fit-image" src="https://i.imgur.com/WIAP9Ku.jpg" width="105px" height="55px"> </div>
                                </div>
                                <div class="col-sm-3 col-5">
                                    <div class='radio mx-auto' data-value="paypal"> <img class="fit-image" src="https://i.imgur.com/cMk1MtK.jpg" width="105px" height="55px"> </div>
                                </div> <br>
                            </div>-->
                            
                            <fieldset>
                                <div style="margin-bottom:15px;">
                                    <label for="card_number">カード番号</label>
                                    <div id="card_number"></div>
                                </div>

                                <div style="margin-bottom:15px;">
                                    <label for="card_expiry">有効期限</label>
                                    <div id="card_expiry"></div>
                                    <input type="hidden" name="cardExpMonth" data-stripe="exp_month">
                                    <input type="hidden" name="cardExpYear" data-stripe="exp_year">
                                </div>

                                <div style="margin-bottom:15px;">
                                    <label for="card-cvc">セキュリティコード</label>
                                    <div id="card-cvc"></div>
                                </div>

                                <div>
                                    <div id="card-errors"></div>
                                </div>
                            </fieldset>  
                            <input type="hidden" name="price" value="{{ $price }}">
    
                            <div class="row justify-content-center" style="margin-top:20px;margin-bottom:20px;">
                                <div class="col-md-12">
                                    <button class="btn btn-pay placeicon">購入を確定する</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
