@extends('layouts.app')

@section('content')
<!--サンドボックスと本番でURLが違う---><script type="text/javascript" src="https://js.squareupsandbox.com/v2/paymentform"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<style>.container-fluid{background-color: #C5CAE9}.heading{font-size: 40px;margin-top: 35px;margin-bottom: 30px;padding-left: 20px}.card{border-radius: 10px !important;margin-top: 60px;margin-bottom: 60px}.form-card{margin-left: 20px;margin-right: 20px}.form-card input, .form-card textarea{padding: 10px 15px 5px 15px;border: none;border: 1px solid lightgrey;border-radius: 6px;margin-bottom: 25px;margin-top: 2px;width: 100%;box-sizing: border-box;font-family: arial;color: #2C3E50;font-size: 14px;letter-spacing: 1px}.form-card input:focus, .form-card textarea:focus{-moz-box-shadow: 0px 0px 0px 1.5px skyblue !important;-webkit-box-shadow: 0px 0px 0px 1.5px skyblue !important;box-shadow: 0px 0px 0px 1.5px skyblue !important;font-weight: bold;border: 1px solid #304FFE;outline-width: 0}.input-group{position:relative;width:100%;overflow:hidden}.input-group input{position:relative;height:80px;margin-left: 1px;margin-right: 1px;border-radius:6px;padding-top: 30px;padding-left: 25px}.input-group label{position:absolute;height: 24px;background: none;border-radius: 6px;line-height: 48px;font-size: 15px;color: gray;width:100%;font-weight:100;padding-left: 25px}input:focus + label{color: #304FFE}.btn-pay{background-color: #304FFE;height: 60px;color: #ffffff !important;font-weight: bold}.btn-pay:hover{background-color: #3F51B5}.fit-image{width: 100%;object-fit: cover}img{border-radius: 5px}.radio-group{position: relative;margin-bottom: 25px}.radio{display:inline-block;border-radius: 6px;box-sizing: border-box;border: 2px solid lightgrey;cursor:pointer;margin: 12px 25px 12px 0px}.radio:hover{box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.2)}.radio.selected{box-shadow: 0px 0px 0px 1px rgba(0, 0, 155, 0.4);border: 2px solid blue}.label-radio{font-weight: bold;color: #000000}</style>


<script>
    var applicationId = "sandbox-sq0idb-emIzoEW1cttlP0zVbzzqeg"; // アプリケーションIDと置き換えます
    var locationId = "LT2NR6YBR349Z";    // 店舗IDと置き換えます

    // ボタンを押したタイミングで実行される関数
    function requestCardNonce(event) {
        event.preventDefault();
        paymentForm.requestCardNonce();
        }

        var paymentForm = new SqPaymentForm({
        // 以下は初期設定です
        applicationId: applicationId,
        locationId: locationId,
        inputClass: 'sq-input',
        inputStyles: [{
            fontSize: '.9em'
        }],
        
        inputStyles: [{
            fontSize: '16px',
            lineHeight: '24px',
            padding: '16px',
            placeholderColor: '#a0a0a0',
            /*backgroundColor: 'transparent',*/
            backgroundColor: '#F5F7F7',
        }],

        // クレジットカード情報のプレイスホルダー
        cardNumber: {
            elementId: 'sq-card-number',
            placeholder: 'カード番号'
        },
        cvv: {
            elementId: 'sq-cvv',
            placeholder: 'CVV'
        },
        expirationDate: {
            elementId: 'sq-expiration-date',
            placeholder: 'MM/YY'
        },
        postalCode: {
            elementId: 'sq-postal-code',
            placeholder: '郵便番号'
        },

        // 各種コールバック
        callbacks: {
            
            createPaymentRequest: function () {
            },
            // nonce 生成後に呼ばれるメソッド
            cardNonceResponseReceived: function(errors, nonce, cardData) {
                if (errors) {
                    // エラーがあった場合
                    var msg = "";
                    //console.log("エラーが発生しました。:");
                    errors.forEach(function(error) {
                    //console.log('  ' + error.message);
                    msg += '  ' + error.message + '\r\n';
                    });
                    alert(msg);
                    return;
                }
                // nonceの値をhiddenの中に入れます
                document.getElementById('card-nonce').value = nonce;
                // 本来のフォームを送信します
                document.getElementById('nonce-form').submit();
            },
            // サポート外のブラウザでアクセスした場合
            unsupportedBrowserDetected: function() {
            },
            // イベントハンドリング
            inputEventReceived: function(inputEvent) {
            },
            // フォームを読み込んだ後のコールバック
            paymentFormLoaded: function() {
            }
        }
    });
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-3">お支払方法の決定</h3>

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class=" col-lg-6 col-md-8">
                        <div class="card p-3">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <h2 class="heading text-center">￥{{ number_format($price) }}</h2>
                                </div>
                            </div>
                            <form action="{{ Request::url() }}" method="POST" id="nonce-form" class="form-card">
                                @csrf
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
                                    <div class="third">
                                        クレジットカード番号(4111 1111 1111 1111)
                                        <div id="sq-card-number"></div>
                                    </div>
                                    <div class="third">
                                        有効期限
                                        <div id="sq-expiration-date"></div>
                                    </div>
                                    <div class="third">
                                        <span class="small">セキュリティコード</span>
                                        <div id="sq-cvv"></div>
                                    </div>
                                    <div class="third">
                                        郵便番号
                                        <div id="sq-postal-code"></div>
                                    </div>
                                </fieldset>  
                                <input type="hidden" id="card-nonce" name="nonce">
                                <input type="hidden" name="price" value="{{ $price }}">
        
                                <div class="row justify-content-center" style="margin-top:20px;">
                                    <div class="col-md-12">
                                        <input type="button" value="購入を確定する" class="btn btn-pay placeicon" onclick="requestCardNonce(event)">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
