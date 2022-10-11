
@if($for == 'partner')
    {{ $user_info->name }}様
@elseif($for == 'user')
    {{ $user_info->name }}様
@elseif($for == 'site_admin' || $for == 'system_admin')
    {{ $user_info->name }}様
@endif

この度はuratabiをご利用いただき、誠にありがとうございます。

お客さまからの体験予約または商品注文を以下の通り承りました。

以下のご注文内容をご確認いただき、誤りなどございましたら、お手数ですが以下のお問い合わせ先までお問い合わせいただけますようお願いいたします。

---------------------------------------------------

ご注文内容

---------------------------------------------------
@if($for == 'partner')
@forelse($ex_infos as $key=>$ex_info)
@if( $ex_info->partner_id == $user_info->id)

■体験予約{{ $key + 1 }}■

【体験日】{{ $ex_info->start_date }}
【体験者名】{{ $ex_info->user->name }}
【体験名】{{ App\Models\ExperienceFolder::where('id', $ex_info->experience->experience_folder_id)->first()->name }}　{{ $ex_info->experience->name }}
【大人】{{ $ex_info->quantity_adult }}名
【子ども】{{ $ex_info->quantity_child }}名
【宿泊グループ】{{ $ex_info->hotelGroup?->name ?? '宿泊なし' }}
【食事グループ】{{ $ex_info->foodGroup?->name ?? '食事なし' }}
【連絡事項】{{ $ex_info->comment ?? 'なし' }}

【体験総額】{{ number_format($ex_info->total_price) }}円

なお、上記の体験予約に関することでご連絡が必要な場合は、
大変お手数ではございますが、下記までお気軽にご連絡ください。

【本件に関するお問合せ先】{{ $ex_info->contact_info }}
【受付時間】10時～16時

---------------------------------------------------
@endif 
@empty
@endforelse
@forelse($goods_infos as $key=>$goods_info)
@if( $goods_info->partner_id == $user_info->id )

■商品注文{{ $key + 1 }}■

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

なお、上記の予約に関することでご連絡が必要な場合は、
大変お手数ではございますが、下記までご連絡ください。

【本件に関するお問合せ先】{{ $goods_info->contact_info }}
【受付時間】10時～16時

---------------------------------------------------
@endif 
@empty
@endforelse
@elseif($for == 'user')
@forelse($ex_infos as $key=>$ex_info)

@if($loop->first)
体験予約を承りました。
@endif

■体験予約{{ $key + 1 }}■

【体験日】{{ $ex_info->start_date }}
【体験者名】{{ $ex_info->user->name }}
【体験名】{{ App\Models\ExperienceFolder::where('id', $ex_info->experience->experience_folder_id)->first()->name }}　{{ $ex_info->experience->name }}
【大人】{{ $ex_info->quantity_adult }}名
【子ども】{{ $ex_info->quantity_child }}名
【宿泊グループ】{{ $ex_info->hotelGroup?->name ?? '宿泊なし' }}
【食事グループ】{{ $ex_info->foodGroup?->name ?? '食事なし' }}
【連絡事項】{{ $ex_info->comment ?? 'なし' }}

【体験総額】{{ number_format($ex_info->total_price) }}円

なお、上記の体験予約に関することでご連絡が必要な場合は、
大変お手数ではございますが、下記までお気軽にご連絡ください。

【本件に関するお問合せ先】{{ $ex_info->contact_info }}
【受付時間】10時～16時

---------------------------------------------------
@empty
@endforelse
@forelse($goods_infos as $key=>$goods_info)

■商品注文{{ $key + 1 }}■

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

なお、上記の予約に関することでご連絡が必要な場合は、
大変お手数ではございますが、下記までご連絡ください。

【本件に関するお問合せ先】{{ $goods_info->contact_info }}
【受付時間】10時～16時

---------------------------------------------------
@empty
@endforelse
@elseif($for == 'site_admin'||$for == 'system_admin')
@forelse($ex_infos as $key=>$ex_info)

■体験予約{{ $key + 1 }}■

【体験日】{{ $ex_info->start_date }}
【体験者名】{{ $ex_info->user->name }}
【体験名】{{ App\Models\ExperienceFolder::where('id', $ex_info->experience->experience_folder_id)->first()->name }}　{{ $ex_info->experience->name }}
【大人】{{ $ex_info->quantity_adult }}名
【子ども】{{ $ex_info->quantity_child }}名
【宿泊グループ】{{ $ex_info->hotelGroup?->name ?? '宿泊なし' }}
【食事グループ】{{ $ex_info->foodGroup?->name ?? '食事なし' }}
【連絡事項】{{ $ex_info->comment ?? 'なし' }}

【体験総額】{{ number_format($ex_info->total_price) }}円

なお、上記の体験予約に関することでご連絡が必要な場合は、
大変お手数ではございますが、下記までお気軽にご連絡ください。

【本件に関するお問合せ先】{{ $ex_info->contact_info }}
【受付時間】10時～16時

---------------------------------------------------
@empty
@endforelse
@forelse($goods_infos as $key=>$goods_info)

■商品注文{{ $key + 1 }}■

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

なお、上記の予約に関することでご連絡が必要な場合は、
大変お手数ではございますが、下記までご連絡ください。

【本件に関するお問合せ先】{{ $goods_info->contact_info }}
【受付時間】10時～16時

---------------------------------------------------
@empty
@endforelse
@endif

商品・体験サービス個別のお問い合わせは上記に記載した【本件に関するお問い合わせ先】にご連絡ください。
当サイトに関する全般的なご質問などございましたら、下記のご連絡先までお気軽にお問い合わせください。

※このメールはuratabiの体験予約または商品注文が完了した方への自動返信メールです。

運営会社：{{ $admin_info->name }}
住所：{{ App\Models\User::$prefs[$admin_info->pref_id] }}{{ $admin_info->city }}{{ $admin_info->town }}{{ $admin_info->building }}
運営連絡先：{{ $admin_info->phone_number }}
TEL：{{ $admin_info->phone_number }}
営業時間：10時～16時



