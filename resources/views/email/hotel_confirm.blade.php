
{{ $user_info->name }}様

この度はuratabiをご利用いただき、誠にありがとうございます。

お客さまの宿泊先が確定いたしましたので体験内容と合わせてご案内させていただきます。

--------------------------------------------------
体験内容
--------------------------------------------------

【体験日】{{ $ex_info->start_date }}
【体験者名】{{ $ex_info->user->name }}
【体験名】{{ App\Models\ExperienceFolder::where('id', $ex_info->experience->experience_folder_id)->first()->name }}　{{ $ex_info->experience->name }}
【大人】{{ $ex_info->quantity_adult }}名
【子ども】{{ $ex_info->quantity_child }}名
【宿泊グループ】{{ $ex_info->hotelGroup?->name ?? '宿泊なし' }}
【食事グループ】{{ $ex_info->foodGroup?->name ?? '食事なし' }}
【連絡事項】{{ $ex_info->comment ?? 'なし' }}

【体験総額】{{ number_format($ex_info->total_price) }}円

--------------------------------------------------
宿泊先情報
--------------------------------------------------

【ご宿泊日】{{ $ex_info->start_date }}
【ご宿泊ホテル名】{{ $hotel_info->name }}
【ご宿泊ホテル所在地】{{ $hotel_info->address }}
【ご宿泊ホテルメールアドレス】{{ $ex_info->mail }}

なお、上記の体験内容、宿泊先情報に関することでご連絡が必要な場合は、
大変お手数ではございますが、下記までお気軽にご連絡ください。

【本件に関するお問合せ先】{{ $ex_info->contact_info }}
【受付時間】10時～16時

--------------------------------------------------


商品・体験サービス個別のお問い合わせは上記に記載した【本件に関するお問い合わせ先】にご連絡ください。
当サイトに関する全般的なご質問などございましたら、下記のご連絡先までお気軽にお問い合わせください。

※このメールはuratabiの体験予約または商品注文が完了した方への自動返信メールです。

---------------------------------------------------
運営会社：{{ $admin_info->name }}
住所：{{ App\Models\User::$prefs[$admin_info->pref_id] }}{{ $admin_info->city }}{{ $admin_info->town }}{{ $admin_info->building }}
運営連絡先：{{ $admin_info->phone_number }}
TEL：{{ $admin_info->phone_number }}
営業時間：10時～16時