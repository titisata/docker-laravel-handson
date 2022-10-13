{{ $user_info->name }}様

この度はuratabiをご利用いただき、誠にありがとうございます。

先日のご注文分に関しまして、
注文のキャンセルを下記のとおり承りましたので
今一度、ご確認をお願い申し上げます。

---------------------------------------------------

【ご注文状況】キャンセル済

---------------------------------------------------

【ご注文日】{{ $goods_info->created_at }}
【ご注文者名】{{ $goods_info->user->name }}
【ご注文商品名】{{ $goods_info->goods->name }}
【ご注文数】{{ $goods_info->quantity }}個

【送り主様情報】
〒{{ $goods_info->from_postal_code }}
【住所】{{ App\Models\User::$prefs[$goods_info->from_pref_id] }}{{ $goods_info->from_city }}{{ $goods_info->from_town }}{{ $goods_info->from_building }}
【氏名】{{ $goods_info->from_name }}様
【電話番号】{{ $goods_info->from_phone_number }}

【商品送付先】
〒{{ $goods_info->to_postal_code }}
【送付先住所】{{ App\Models\User::$prefs[$goods_info->to_pref_id] }}{{ $goods_info->to_city }}{{ $goods_info->to_town }}{{ $goods_info->to_building }}
【送付先氏名】{{ $goods_info->to_name }}様
【送付先電話番号】{{ $goods_info->to_phone_number }}

【ご注文総額】{{ number_format($goods_info->total_price) }}円


【本件に関するお問合せ先】{{ $goods_info->contact_info }}
【受付時間】10時～16時

---------------------------------------------------

商品個別のお問い合わせは上記に記載した【本件に関するお問い合わせ先】にご連絡ください。
当サイトに関する全般的なご質問などございましたら、下記のご連絡先までお気軽にお問い合わせください。

※このメールはuratabiの商品受注状況の変更が完了した方への自動返信メールです。

運営会社：{{ $admin_info->name }}
住所：{{ App\Models\User::$prefs[$admin_info->pref_id] }}{{ $admin_info->city }}{{ $admin_info->town }}{{ $admin_info->building }}
運営連絡先：{{ $admin_info->phone_number }}
TEL：{{ $admin_info->phone_number }}
営業時間：10時～16時


