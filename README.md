## アプリケーション名
「Rese（リーズ）」<br>
 Reseはある企業のグループ会社の飲食店予約アプリです。


## 作成した目的
このアプリはLaravel学習の総まとめとして作成しました。 与えられた要件や成果物イメージをもとに、テーブル定義・ER図作成・コーディングをおこないました。

## アプリケーション URL
　開発環境
* ユーザーサイト：http://localhost/<br>
* phpMyAdmin：http://localhost:8080/<br>
* mailhog：http://localhost:8025/<br>

　本番環境
* ユーザーサイト：http://52.199.182.201<br>
* phpMyAdmin：http://52.199.182.201:8080<br>
* mailhog：http://52.199.182.201:8025<br>


## 他のリポジトリ
なし

## 機能一覧
* 会員登録機能（入力項目は名前、メールアドレス、パスワード）<br>
  左上のハンバーガーメニューの"register"から会員登録画面を表示する。
  登録時は登録されたメールアドレスに確認メールが送信される。
* メール認証機能（会員登録時、MailHogにメールが届き、認証することで会員登録ができる）
* ログイン（メールアドレスとパスワードで認証）
* ログアウト機能（左上のハンバーガーメニューから"Logout"を押下）

* 検索<br>
→トップページの右上の検索メニューから、エリア、ジャンル、店舗名ごとに店舗を検索することができる。検索実行時は、トップページに検索された店舗のみが表示される。検索実行はEnterキーをクリック<br>
* 店舗詳細表示<br>
→トップページの各店舗情報の"詳しくみる"ボタンを押すと店舗詳細画面を表示する。
* 予約<br>
→店舗詳細画面から予約することができる。
* マイページ表示<br>
→ログインしたユーザーは、左上のハンバーガーメニューの"Mypage"ボタンから、予約情報やお気に入り店舗情報を記載したマイページをみることができる。
* 予約変更・キャンセル<br>
マイページに表示された各予約情報の"変更"ボタンから予約情報の変更、キャンセルボタンからキャンセルができる。
予約変更は、当日の1時間以降は選択できる。<br>
* QRコード表示<br>
マイページに表示された各予約情報の"QRコード"アイコンボタンから、来店時に提示するためのQRコードを表示することができる。
* 決済機能<br>
マイページに表示された各予約情報の"決済"アイコンボタンから、コースを選択し、決済できる。<br>
  * テストカード情報<br>
    →カード番号：4242424242424242<br>
    →ブランド：Visa
* お気に入り登録・解除<br>
ログインしたユーザーは、トップページの各店舗のハートマーク（ログインしていない時は表示されない）をクリックすることで、お気に入り登録と解除ができる。
お気に入り登録されるとハートマークが赤くなり、マイページに店舗情報が表示されるようになる。<br>
* 評価機能<br>
店舗詳細画面左下の"口コミを投稿する"表示を押すと星5段階評価とコメントが投稿できる。<br>
投稿後、店舗詳細画面より評価の変更、削除ができる<br>
* リマインダー機能<br>
毎朝8：00に当日の予約があるユーザーに予約確認メールを送信する。<br>
バッチを動かすには「php artisan schedule:work」のコマンドをうつ<br>
    * 動作確認方法<br>
    1. フロント側で予約を作成する
    2. phpMyAdminで予約日を当日に変更する<br>
    3. ターミナルでphpコンテナにログイン<br>
    「docker exec -it rese_system-php-1 bash」
    4. 「php artisan command:sendMail」とコマンド入力<br>
    4. MailHogにリマインドメールが届く<br>
* 管理者・店舗代表者のログイン<br>
上記アプリケーションURLに"admin/login"をつけたURLを直打ちするとログイン画面が表示される。
* 管理者権限（role:1）で出来ること<br>
→管理者・店舗代表者一覧ページから店舗代表者・管理者を作成できる<br>
→利用者にお知らせメールを送信できる<br>
* 店舗代表者権限（role:2）で出来ること<br>
→店舗情報一覧ページから店舗情報の作成・更新・削除<br>
→予約情報一覧ページの閲覧<br>
→お店の画像をストレージ（S3）に保存<br>
   * 管理者サンプル<br>
     * email => admin@example.com<br>
     * password => 'password'<br>
   * 店舗代表者サンプル
     * email => owner@example.com<br>
     * password => 'password'<br>

## 追加機能
* 口コミ機能<br>
会員登録したユーザは店舗詳細画面から口コミを投稿、編集、削除することができる。なお、同じ店舗に同一のユーザが複数の口コミを行うことはできない。
管理者は、管理画面（"admin/index"）の「口コミ一覧」から全ての口コミの閲覧と削除ができる。
* 店舗一覧ソート機能<br>
トップページのヘッダー中央付近の「並び替え：評価高/低」タブから、同画面に表示する店舗を並び変えることができる。並び替え方法は、"ランダム"、"口コミ評価が高い順"、"口コミ評価が低い順"から選択できる。
* csvインポート機能<br>
管理者は、管理画面（"admin/index"）の「店舗情報csvインポート」から、複数の新規店舗を、csvファイルをアップロードすることにより一括して追加することができる。
  * csvファイルの仕様
    * 文字コード: UTF-8
    * カンマ区切り
    * 1行目はヘッダ情報
    * 項目は全て入力必須
    * 'name'列: 店舗名 50文字以内
    * 'area'列: 地域　'東京都'、'大阪府'、'福岡県'のいずれか
    * 'genre'列: ジャンル　'寿司'、'焼肉'、'イタリアン'、'居酒屋'、'ラーメン'のいずれか
    * 'description'列: 店舗概要 400文字以内
    * 'image_url'列: 画像のURL ファイルの種類(拡張子)は'.jpeg'、'.jpg'、'.png'に対応
  * CSVファイル作成方法
    1. スプレットシート新規作成を開き、1行目に「area」「genre」「name」「description」「image_url」を入力する
    2. 2行目から作成したい店舗のデータを入力する
    3. 入力後、左上付近の「ファイル」→ダウンロード→「カンマ区切り形式（.csv）」を選択し、保存する
    <img width="929" alt="スクリーンショット 2024-10-31 21 24 24" src="https://github.com/user-attachments/assets/d8ce7a9f-59f7-414d-bca8-dee15fd11695">

        <img width="200" alt="スクリーンショット 2024-10-31 21 25 11" src="https://github.com/user-attachments/assets/cc1912fa-c2fb-46de-8ad5-9757b50563b9">





## 使用技術
* PHP 7.4.9
* Laravel 8.83.27
* MySQL　8.0.26


## テーブル設計
<img width="664" alt="スクリーンショット 2024-10-23 18 59 57" src="https://github.com/user-attachments/assets/16421fe7-2a43-4d58-9529-afd5f2fab352">
<img width="664" alt="スクリーンショット 2024-10-23 19 00 31" src="https://github.com/user-attachments/assets/79a0b4c5-4082-4225-8b74-37cd11a4576f">
<img width="664" alt="スクリーンショット 2024-10-23 19 00 48" src="https://github.com/user-attachments/assets/6ff856a4-2faa-4e2c-8b93-5e4576a56480">
<img width="664" alt="スクリーンショット 2024-10-23 19 01 02" src="https://github.com/user-attachments/assets/ba10a630-8f68-43be-9c85-48decc90ea4b">


## ER図
<img width="652" alt="スクリーンショット 2024-10-23 19 04 12" src="https://github.com/user-attachments/assets/dd6ecf93-049c-4075-91cd-39a44697e269">

## 環境構築
Docker ビルド
1. git clone git@github.com:mizuki44/rese_system.git
2. cd rese_system
3. DockerDesktopアプリを立ち上げる
4. docker-compose up -d --build

## Laravel環境構築<br>
1. コンテナに入る<br>
docker-compose exec php bash
2. composerをインストールする<br>
composer install
3. 新しく.envファイルを作成<br>
<pre>
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
# MAIL_FROM_ADDRESS=null
MAIL_FROM_ADDRESS=info@example.com
MAIL_FROM_NAME="${APP_NAME}"

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

STRIPE_KEY=pk_test_51PXg28Bxqwjkh0Qxx44UY1PvjPd7wcaf1JVVwESDsVYhoFVf7WT418m5XZTAcsCfmQb0VEISP5iCuHByMsK8drPj002t3ljfMs
STRIPE_SECRET=sk_test_51PXg28Bxqwjkh0QxRKfL2iuFxMSQjIby3BQl9jYRXT1Tw7lf8YI3nqHOPlMLT9mul9ljlQlOG8FpkihiTOp3KIne00z46CpRJ8
</pre>
4. keyを生成する<br>
php artisan key:generate
5. マイグレーションの実行<br>
php artisan migrate
6. シーディングの実行<br>
php artisan db:seed
7. ユーザーの場合→トップページ左上のハンバーガーメニュー内「register」より会員登録
8. 管理者の場合→アプリケーションURLに"admin/login"をつけたURLを直打ちし、サンプル管理者でログイン<br>
  もしくは"admin/register"をつけたURLを直打ちし、管理者を新規作成しログイン
