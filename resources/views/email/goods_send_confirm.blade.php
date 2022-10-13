
{{ $user_info->name }}様

この度はuratabiをご利用いただき、誠にありがとうございます。

商品の発送が完了いたしました。

以下のお届け内容をご確認いただき、誤りなどございましたら、
お手数ですが以下のお問い合わせ先までお問い合わせいただけますようお願いいたします。

【お問合せ先】{{ $goods_info->contact_info }}

●お荷物のお届け先内容

【お名前】{{ $goods_info->to_name }}様
【ご住所】{{ App\Models\User::$prefs[$goods_info->to_pref_id] }}{{ $goods_info->to_city }}{{ $goods_info->to_town }}{{ $goods_info->to_building }}
【電話番号】{{ $goods_info->to_phone_number }}
【配送会社】@if(is_numeric($goods_info->delivery_company)){{App\Consts\DeliveryConst::DELIVERY_LIST[$goods_info->delivery_company]}}@else{{ $goods_info->delivery_company }}@endif
【配送伝票番号】{{ $goods_info->delivery_number }}

お届け日時の変更をご希望の場合は、配送会社に直接ご連絡ください。

この度は、お買い上げ誠にありがとうございました。
またのご利用をスタッフ一同、心よりお待ちしております。

その他、ご不明な点がございましたら当店まで
お問い合わせくださいませ。

---------------------------------------------------

運営会社：{{ $admin_info->name }}
住所：{{ App\Models\User::$prefs[$admin_info->pref_id] }}{{ $admin_info->city }}{{ $admin_info->town }}{{ $admin_info->building }}
運営連絡先：{{ $admin_info->phone_number }}
TEL：{{ $admin_info->phone_number }}
営業時間：10時～16時

