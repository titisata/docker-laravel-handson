{{ $name }}さん


{{ $status }}となりました。

@if($for == 'partner')
パートナー向けの文章です。
@elseif($for == 'user')
予約者向けの文章です。
@elseif($for == 'admin')
管理者向けの文章です。
@endif

