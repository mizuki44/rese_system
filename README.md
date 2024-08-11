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
* ログアウト機能（左上の左上のハンバーガーメニューから"Logout"を押下）

* 検索<br>
→トップページの右上の検索メニューから、エリア、ジャンル、店舗名ごとに店舗を検索することができる。検索実行時は、トップページに検索された店舗のみが表示される。<br>
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
マイページに表示された各予約情報の"決済"アイコンボタンから、コースを選択し、決済できる。
* お気に入り登録・解除<br>
ログインしたユーザーは、トップページの各店舗のハートマーク（ログインしていない時は表示されない）をクリックすることで、お気に入り登録と解除ができる。
お気に入り登録されるとハートマークが赤くなり、マイページに店舗情報が表示されるようになる。<br>
* 評価機能<br>
店舗詳細画面左下の"口コミを投稿する"表示を押すと星5段階評価とコメントが投稿できる。<br>
* リマインダー機能<br>
毎朝8：00に当日の予約があるユーザーに予約確認メールを送信する。<br>
バッチを動かすには"php artisan schedule:work"のコマンドをうつ<br>
    * 動作確認方法<br>
    1. 当日の予約を作成する<br>
    2. ターミナルでphpコンテナにログイン<br>
    「docker exec -it rese_system-php-1 bash」
    3. 「php artisan command:sendMail」とコマンド入力<br>
    4. MailHogにリマインドメールが届く<br>
* 管理者・店舗代表者のログイン<br>
上記アプリケーションURLに"admin/login"をつけたURLを直打ちするとログイン画面が表示される。
* 管理者権限（role:1）で出来ること<br>
→管理者・店舗代表者一覧ページから店舗代表者を作成できる<br>
→利用者にお知らせメールを送信できる<br>
* 店舗代表者権限（role:2）で出来ること<br>
→店舗情報一覧ページから店舗情報の作成・更新<br>
→予約情報一覧ページの閲覧<br>
→お店の画像をストレージ（S3）に保存<br>
   * 管理者サンプル<br>
     * email => admin@example.com<br>
     * password => 'password'<br>
   * 店舗代表者サンプル
     * email => owner@example.com<br>
     * password => 'password'<br>




## 使用技術
* PHP 7.4.9
* Laravel 8.83.27
* MySQL　8.0.26


## テーブル設計
<img width="649" alt="スクリーンショット 2024-08-10 17 58 05" src="https://github.com/user-attachments/assets/9649b36d-4117-4213-b942-92649ff0f505">
<img width="649" alt="スクリーンショット 2024-08-10 17 58 50" src="https://github.com/user-attachments/assets/a82007f1-7a43-4771-ab27-ac2e02a696c1">
<img width="649" alt="スクリーンショット 2024-08-10 17 59 06" src="https://github.com/user-attachments/assets/e324d7ed-15a8-4e5a-b61d-e5e656e6ef9c">



## ER図
<img width="840" alt="スクリーンショット 2024-08-11 16 05 10" src="https://github.com/user-attachments/assets/1ca3fcca-f54c-42a3-adad-1a464c633523">



## 環境構築
Docker ビルド
1. git clone git@github.com:mizuki44/rese_system.git
2. DockerDesktopアプリを立ち上げる
3. docker-compose up -d --build

## Laravel環境構築<br>
1. コンテナに入る<br>
docker-compose exec php bash
2. composerをインストールする<br>
composer install
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更する。
または、新しく.envファイルを作成
4. .envに以下の環境変数を追加<br>
<pre>
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

MAIL_FROM_ADDRESS=info@example.com
</pre>
5. keyを生成する<br>
php artisan key:generate
6. マイグレーションの実行<br>
php artisan migrate
7. シーディングの実行<br>
php artisan db:seed
8. ユーザーの場合→トップページ左上のハンバーガーメニュー内「register」より会員登録
9. 管理者の場合→アプリケーションURLに"admin/login"をつけたURLを直打ちし、サンプル管理者でログイン
