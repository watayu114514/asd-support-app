# ASD仕事アシスタント 管理画面設計書

---

# 1. 管理画面概要

## 目的

サービス運営者が以下を管理する。

- ユーザー管理
- AI利用状況管理
- AIコスト管理
- 売上管理
- 利用状況分析
- サービス改善


---

# 2. 管理画面アクセス

## URL

/admin


## 認証

管理者権限のみ利用可能。


## 権限

role:

admin

support


---

# 3. 管理画面一覧


|ID|画面名|URL|優先度|
|-|-|-|-|
|ADMIN-001|管理ダッシュボード|/admin|必須|
|ADMIN-002|ユーザー一覧|/admin/users|必須|
|ADMIN-003|ユーザー詳細|/admin/users/{id}|必須|
|ADMIN-004|AI利用分析|/admin/ai|必須|
|ADMIN-005|売上管理|/admin/revenue|Phase2|
|ADMIN-006|イベント分析|/admin/events|Phase2|


---

# 4. ADMIN-001 管理ダッシュボード


## 目的

サービス全体の状況を確認する。


## 表示カード


### ユーザー情報

表示:

- 総登録ユーザー数
- 無料ユーザー数
- 有料ユーザー数


API:

GET

/api/admin/dashboard


---

### AI利用情報


表示:

- 今日のAI利用回数
- 月間AI利用回数
- AI利用料金


---

### 売上情報


表示:

- 月売上
- 契約人数
- 継続率


---

# 5. ADMIN-002 ユーザー一覧


## 目的

利用ユーザーを管理する。


## 表示項目


|項目|内容|
|-|-|
|ID|ユーザーID|
|名前|ユーザー名|
|メール|メールアドレス|
|プラン|free/standard/pro|
|登録日|登録日時|
|最終利用日|最終アクセス日時|


---

## 検索機能


条件:

- 名前
- メールアドレス
- プラン


---

## API


GET

/api/admin/users


---

# 6. ADMIN-003 ユーザー詳細


## 目的

ユーザー単位の利用状況を確認する。


## 表示項目


ユーザー情報:

- 名前
- メール
- 登録日


利用情報:

- タスク数
- 手順書数
- AI利用回数
- AI利用料金


契約情報:

- プラン
- 契約状態


---

## API


GET

/api/admin/users/{id}


---

# 7. ADMIN-004 AI利用分析


## 目的

AIコストを管理する。


## 表示項目


### 利用量


- AI利用回数
- Token数
- モデル別利用量


### コスト


- 日別AI費用
- 月別AI費用
- ユーザー別費用


---

## グラフ


表示:

- AI利用数推移
- Token使用量推移
- AI費用推移


---

## API


GET

/api/admin/ai


---

# 8. ADMIN-005 売上管理


## 目的

収益状況を確認する。


## 表示項目


- 月売上
- 有料会員数
- 新規契約数
- 解約数
- 継続率


---

## グラフ


表示:

- 売上推移
- 契約者数推移


---

## API


GET

/api/admin/revenue


---

# 9. ADMIN-006 イベント分析


## 目的

ユーザー行動を分析する。


## 分析対象


イベント:

- login
- task_created
- task_completed
- ai_requested
- subscription_started


---

## 表示


- 利用頻度
- 継続率
- 離脱ポイント


---

## API


GET

/api/admin/events


---

# 10. 管理画面共通UI


## Header


表示:

- ロゴ
- 管理者名
- ログアウト


---

## Sidebar


メニュー:

- ダッシュボード
- ユーザー管理
- AI分析
- 売上管理
- イベント分析


---

# 11. Vueコンポーネント構成


```text
AdminLayout.vue

pages/admin/
 |
 |- Dashboard.vue
 |- Users.vue
 |- UserDetail.vue
 |- AIAnalytics.vue
 |- Revenue.vue
 |- Events.vue


components/admin/

 |- AdminHeader.vue
 |- AdminSidebar.vue
 |- StatCard.vue
 |- ChartCard.vue
 |- UserTable.vue