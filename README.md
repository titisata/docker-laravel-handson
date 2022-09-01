# URATABI

URATABI の Lravel プロジェクトです。

## 初期化処理

```shell
composer install
php artisan migrate:fresh --seed
```

## 初期ユーザー

```txt
mail: test@gmail.com
pass: pass1234
```

## ロールについて

`roles` テーブルで管理されている `role` の対応表
1 -> システム管理者 (ソールドアウト): admin
2 -> サイトオーナー (観光協会): owner
3 -> パートナー: partner
ユーザーロールはデフォで全員存在すると考える
