# ASD仕事アシスタント 画面設計書

## 1. 画面一覧

| No | 画面ID | 画面名 | URL | 認証 | 優先度 |
|---|---|---|---|---|---|
|1|SCR-001|ログイン|/login|不要|必須|
|2|SCR-002|会員登録|/register|不要|必須|
|3|SCR-003|ダッシュボード|/dashboard|必要|必須|
|4|SCR-004|タスク一覧|/tasks|必要|必須|
|5|SCR-005|タスク作成|/tasks/create|必要|必須|
|6|SCR-006|タスク編集|/tasks/{id}/edit|必要|必須|
|7|SCR-007|手順書一覧|/manuals|必要|必須|
|8|SCR-008|手順書詳細|/manuals/{id}|必要|必須|
|9|SCR-009|手順書作成|/manuals/create|必要|必須|
|10|SCR-010|AI相談|/ai/chat|必要|必須|
|11|SCR-011|AI履歴|/ai/history|必要|任意|
|12|SCR-012|設定|/settings|必要|任意|
|13|SCR-013|管理画面|/admin|管理者|Phase3|

---

# 2. 共通レイアウト

## Header

表示項目:

- ロゴ
- ユーザー名
- 通知
- メニュー

---

## Sidebar

メニュー:

- ホーム
- タスク
- 手順書
- AI相談
- 振り返り
- 設定

---

## レスポンシブ対応

スマートフォンでは:

- サイドバーを折り畳む
- ボタンサイズを大きくする
- 入力フォームを縦配置する

---

# SCR-001 ログイン

## 目的

登録済みユーザーがログインする。

## 入力項目

### メールアドレス

- 必須
- email形式
- 最大255文字

### パスワード

- 必須
- 最大255文字

## ボタン

ログイン

API:

POST /api/login

成功:

/dashboardへ遷移

失敗:

エラーメッセージ表示

---

# SCR-002 会員登録

## 目的

新規ユーザー登録。

## 入力項目

名前

- 必須
- 最大50文字

メールアドレス

- 必須
- email形式

パスワード

- 必須
- 8文字以上

パスワード確認

- 必須

## API

POST /api/register

---

# SCR-003 ダッシュボード

## 目的

ログイン後のホーム画面。

## 表示項目

### 今日のタスク

表示:

- タイトル
- 優先度
- 期限
- 状態

---

### AI相談

表示:

- 入力欄
- 相談ボタン

例:

「仕事が多すぎて整理できません」

---

### 最近の手順書

表示:

最大5件

---

### AI利用状況

表示例:

AI利用:

3 / 30回

---

## API

GET /api/dashboard

---

# SCR-004 タスク一覧

## 目的

仕事を管理する。

## 表示項目

- タイトル
- 優先度
- 期限
- 状態

## 操作

追加

GET:

/tasks/create


編集

GET:

/tasks/{id}/edit


完了

PATCH:

/api/tasks/{id}/complete


削除

DELETE:

/api/tasks/{id}

---

# SCR-005 タスク作成

## 入力項目

タイトル

- 必須
- 最大100文字

説明

- 最大1000文字

優先度

選択:

- low
- normal
- high

期限

- date

## API

POST /api/tasks

---

# SCR-006 タスク編集

作成画面と同じ項目。

## API

PUT /api/tasks/{id}

---

# SCR-007 手順書一覧

## 目的

仕事手順を管理する。

## 表示

例:

- 電話対応
- メール返信
- 会議準備
- 資料作成

## API

GET /api/manuals

---

# SCR-008 手順書詳細

## 表示

タイトル:

電話対応

手順:

1. メモを準備
2. 名前確認
3. 用件確認
4. 復唱
5. 記録

## 操作

- 完了チェック
- 編集
- 削除

## API

GET /api/manuals/{id}

---

# SCR-009 手順書作成

## 入力

タイトル

説明

手順一覧

例:

STEP1

STEP2

STEP3

## API

POST /api/manuals

---

# SCR-010 AI相談

## 目的

仕事の悩みをAIへ相談する。

## 画面構成

- 会話履歴
- 入力欄
- 送信ボタン
- AI回答

## 入力補助

テンプレート:

- 優先順位を整理する
- 上司への確認文を作る
- 作業手順を作る
- メールを書く

## API

送信:

POST /api/ai/chat

履歴:

GET /api/ai/conversations

---

# SCR-011 AI履歴

## 表示

過去相談一覧

例:

- 資料作成について
- 上司への相談
- 仕事整理

## API

GET /api/ai/conversations

---

# SCR-012 設定

表示:

- プロフィール変更
- メール変更
- パスワード変更
- 通知設定
- プラン確認
- 退会

---

# SCR-013 管理画面

## 対象

管理者のみ。

## 表示カード

- 登録ユーザー数
- 有料会員数
- AI利用数
- AIコスト
- 売上

## グラフ

- ユーザー増加
- 売上推移
- AI利用量
- AIコスト

## API

GET /api/admin/dashboard

---

# 3. 共通エラー

## バリデーションエラー

例:

メールアドレスを入力してください。

---

## APIエラー

例:

通信に失敗しました。

時間を置いて再度お試しください。

---

# 4. Vueコンポーネント対応

|画面|Component|
|-|-|
|Dashboard|Dashboard.vue|
|Task一覧|TaskList.vue|
|Taskカード|TaskCard.vue|
|Manual一覧|ManualList.vue|
|Manual詳細|ManualDetail.vue|
|AIチャット|ChatBox.vue|
|Header|Header.vue|
|Sidebar|Sidebar.vue|

---

# 5. 実装優先順位

## Phase1

- Login
- Register
- Dashboard
- Task
- Manual
- AI Chat

## Phase2

- AI History
- Settings

## Phase3

- Admin
- Analytics