# アプリケーション名
## 概要説明
## アプリケーションURL

## 他のリポジトリ

## 機能一覧
*管理者*
- 店舗代表者登録
- メール一括送信

*店舗代表者*
- レストラン登録
- 予約一覧表示
- QRによる予約確認

*一般ユーザー*
- 新規登録
- ログイン・ログアウト
- レストランの一覧表示
- レストランの検索・絞り込み
- レストラン予約機能
- レビュー投稿・評価機能
- マイページ
- 支払い機能



## 使用技術(実行環境)
- PHP 8.1
- Laravel 10.48.17
- MySQL 8.0.26

## テーブル設計

## ER図

## 環境構築
### Dockerビルド
1. git clone git@github.com:AKawamuraCop/Rese.git
2. DockerDesktopアプリを立ち上げる
3. docker-compose up -d —build

### Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. 「.env.example」ファイルを「.env」ファイルに命名を変更。または、新しく.envファイルを作成。
4. .envに以下の環境変数を追加
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
```
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=your_email@example.com
MAIL_FROM_NAME="Your Name or Your App Name"
```
```
STRIPE_PUBLIC_KEY=自分の公開キー
STRIPE_SECRET_KEY=自分のシークレットキー
```

5. Cronに下記を追加
```
* * * * * /usr/local/bin/docker exec rese-php-1 php /var/www/artisan schedule:run >> /path-to-your-project/schedule.log 2>&1
```

6. アプリケーションキーの作成
```
php artisan key:generate
```
7. マイグレーションの実行
```
php artisan migrate
```
8. シーディングの実行
```
php artisan db:seed
```

## アカウントの種類

テストユーザー

## URL
・開発環境：http://localhost/
・phpMyAdmin : http://localhost:8080/