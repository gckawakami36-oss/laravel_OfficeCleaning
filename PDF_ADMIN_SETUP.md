# PDF出力・管理者権限実装ガイド

## 実装内容

### 1. 管理者権限システム
- Userモデルに`role`カラムを追加（デフォルト: 'user'）
- 管理者チェック機能（`isAdmin()`、`hasRole()`メソッド）
- 管理者専用ミドルウェア（`AdminMiddleware`）

### 2. PDF出力機能
- 商品一覧のPDF出力（管理者のみ）
- 個別商品のPDF出力（管理者のみ）
- 日本語対応のPDFテンプレート

## セットアップ手順

### 1. マイグレーションの実行

```bash
php artisan migrate
```

これにより、usersテーブルに`role`カラムが追加されます。

### 2. PDF設定ファイルの公開（オプション）

```bash
php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
```

### 3. 管理者ユーザーの作成

#### 方法A: シーダーを使用する場合

既存のユーザーデータをリセットして、新しいユーザーとして管理者を作成します：

```bash
php artisan migrate:fresh --seed
```

これにより以下のユーザーが作成されます：
- 一般ユーザー: test@test.com / password123
- 管理者: admin@test.com / password123

#### 方法B: 既存ユーザーを管理者に変更する場合

データベースを直接編集するか、Tinkerを使用します：

```bash
php artisan tinker
```

Tinker内で以下を実行：

```php
$user = App\Models\User::where('email', 'test@example.com')->first();
$user->role = 'admin';
$user->save();
```

#### 方法C: 新しい管理者ユーザーを手動で作成する場合

Tinkerで：

```php
App\Models\User::create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => bcrypt('your-password'),
    'role' => 'admin'
]);
```

## 使用方法

### PDF出力機能

管理者ユーザーでログインすると、以下の場所にPDF出力ボタンが表示されます：

1. **商品一覧ページ** (`/items`)
   - 「PDF出力」ボタン → 全商品の一覧PDFをダウンロード

2. **商品詳細ページ** (`/items/{id}`)
   - 「PDF出力」ボタン → その商品の詳細PDFをダウンロード

一般ユーザーでログインした場合、これらのボタンは表示されません。

### 管理者権限の確認

ルートに管理者ミドルウェアを適用するには：

```php
Route::middleware(['auth', 'admin'])->group(function () {
    // 管理者のみアクセス可能なルート
});
```

コントローラーやビューで管理者チェック：

```php
// Controller
if (Auth::user()->isAdmin()) {
    // 管理者のみの処理
}

// Blade
@if(Auth::user()->isAdmin())
    <!-- 管理者のみ表示 -->
@endif
```

## ファイル構成

### 追加・変更されたファイル

#### バックエンド
- `database/migrations/2026_02_05_000000_add_role_to_users_table.php` - ロール追加マイグレーション
- `app/Models/User.php` - 管理者チェック機能追加
- `app/Http/Middleware/AdminMiddleware.php` - 管理者ミドルウェア
- `app/Http/Kernel.php` - ミドルウェア登録
- `app/Http/Controllers/ItemController.php` - PDF出力メソッド追加
- `database/seeders/UserSeeder.php` - 管理者ユーザー追加
- `resources/views/pdf/items.blade.php` - 商品一覧PDFテンプレート
- `resources/views/pdf/item.blade.php` - 商品詳細PDFテンプレート
- `routes/web.php` - PDF出力ルート追加

#### フロントエンド
- `resources/js/Pages/Items/Index.vue` - PDF出力ボタン追加
- `resources/js/Pages/Items/Show.vue` - PDF出力ボタン追加

## トラブルシューティング

### PDFが日本語で表示されない場合

`config/dompdf.php`を編集し、フォント設定を調整してください。

### 管理者ボタンが表示されない場合

1. ユーザーの`role`が'admin'に設定されているか確認
2. ブラウザのキャッシュをクリア
3. `npm run dev`または`npm run build`でフロントエンドを再ビルド

### 403エラーが表示される場合

ログインユーザーの`role`が'admin'でない可能性があります。データベースを確認してください。
