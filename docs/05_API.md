# ASD仕事アシスタント API設計書

## 1. API概要

## Backend

Laravel API


## Authentication

Laravel Sanctum


## Base URL

/api


## Response Format

成功:

{
    "success": true,
    "data": {}
}


失敗:

{
    "success": false,
    "message": "エラーメッセージ",
    "errors": {}
}


---

# 2. 認証API

## AUTH-001 会員登録

### Endpoint

POST

/api/register


### Request

{
    "name": "田中太郎",
    "email": "test@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}


### Response

{
    "success": true,
    "data": {
        "user": {}
    }
}


---

## AUTH-002 ログイン

### Endpoint

POST

/api/login


### Request

{
    "email": "test@example.com",
    "password": "password123"
}


### Response

{
    "success": true,
    "data": {
        "token": "xxxxx",
        "user": {}
    }
}


---

## AUTH-003 ログアウト

### Endpoint

POST

/api/logout


### Response

{
    "success": true
}


---

# 3. ユーザーAPI

## USER-001 ユーザー情報取得

### Endpoint

GET

/api/user


### Response

{
    "success": true,
    "data": {
        "id":1,
        "name":"田中太郎",
        "email":"test@example.com"
    }
}


---

## USER-002 ユーザー情報更新

### Endpoint

PUT

/api/user


### Request

{
    "name":"田中太郎"
}


---

# 4. ダッシュボードAPI

## DASH-001 ダッシュボード取得

### Endpoint

GET

/api/dashboard


### Response

{
    "success": true,
    "data": {
        "tasks": [],
        "manuals": [],
        "ai_usage": {}
    }
}


---

# 5. タスクAPI

## TASK-001 タスク一覧取得

### Endpoint

GET

/api/tasks


### Response

{
    "success": true,
    "data": []
}


---

## TASK-002 タスク作成

### Endpoint

POST

/api/tasks


### Request

{
    "title":"資料作成",
    "description":"月次資料を作成",
    "priority":"high",
    "due_date":"2026-08-01"
}


### Response

{
    "success": true,
    "data": {}
}


---

## TASK-003 タスク詳細取得

### Endpoint

GET

/api/tasks/{id}


---

## TASK-004 タスク更新

### Endpoint

PUT

/api/tasks/{id}


### Request

{
    "title":"更新タイトル",
    "priority":"normal"
}


---

## TASK-005 タスク完了

### Endpoint

PATCH

/api/tasks/{id}/complete


---

## TASK-006 タスク削除

### Endpoint

DELETE

/api/tasks/{id}


---

# 6. 手順書API

## MANUAL-001 手順書一覧取得

### Endpoint

GET

/api/manuals


---

## MANUAL-002 手順書詳細取得

### Endpoint

GET

/api/manuals/{id}


---

## MANUAL-003 手順書作成

### Endpoint

POST

/api/manuals


### Request

{
    "title":"電話対応",
    "description":"電話対応手順"
}


---

## MANUAL-004 手順追加

### Endpoint

POST

/api/manuals/{id}/steps


### Request

{
    "step_number":1,
    "content":"名前を確認する"
}


---

## MANUAL-005 手順更新

### Endpoint

PUT

/api/manuals/{id}/steps/{step_id}


---

## MANUAL-006 手順削除

### Endpoint

DELETE

/api/manuals/{id}/steps/{step_id}


---

# 7. AI相談API

## AI-001 AI相談開始

### Endpoint

POST

/api/ai/chat


### Request

{
    "feature":"task_division",
    "message":"資料をまとめてと言われました"
}


### Response

{
    "success":true,
    "data":{
        "answer":"作業を分解します"
    }
}


---

## AI-002 AI会話履歴取得

### Endpoint

GET

/api/ai/conversations


---

## AI-003 AI会話詳細取得

### Endpoint

GET

/api/ai/conversations/{id}


---

## AI-004 AI回答評価

### Endpoint

POST

/api/ai/feedback


### Request

{
    "conversation_id":1,
    "rating":"good",
    "comment":"役に立った"
}


---

# 8. AI利用管理API

## AI-USAGE-001 利用状況取得

### Endpoint

GET

/api/ai/usage


### Response

{
    "success":true,
    "data":{
        "used":3,
        "limit":30
    }
}


---

# 9. 振り返りAPI

## REFLECTION-001 振り返り登録

### Endpoint

POST

/api/reflections


### Request

{
    "completed_today":"資料作成完了",
    "problem":"確認不足があった"
}


---

## REFLECTION-002 振り返り一覧取得

### Endpoint

GET

/api/reflections


---

# 10. サブスクリプションAPI

## SUB-001 プラン取得

### Endpoint

GET

/api/subscription


---

## SUB-002 購入開始

### Endpoint

POST

/api/subscription/create


### Request

{
    "plan":"standard"
}


---

## SUB-003 解約

### Endpoint

POST

/api/subscription/cancel


---

# 11. 管理者API

## ADMIN-001 管理ダッシュボード

### Endpoint

GET

/api/admin/dashboard


### Response

{
    "users":100,
    "paid_users":20,
    "ai_cost":5000,
    "revenue":19800
}


---

## ADMIN-002 AI利用分析

### Endpoint

GET

/api/admin/ai


表示:

- 利用回数
- Token数
- AI費用
- ユーザー別利用量


---

## ADMIN-003 売上分析

### Endpoint

GET

/api/admin/revenue


表示:

- 月売上
- 契約人数
- 継続率


---

# 12. API一覧

|ID|Endpoint|Method|用途|
|-|-|-|-|
|AUTH-001|/register|POST|会員登録|
|AUTH-002|/login|POST|ログイン|
|AUTH-003|/logout|POST|ログアウト|
|DASH-001|/dashboard|GET|ダッシュボード|
|TASK-001|/tasks|GET|一覧|
|TASK-002|/tasks|POST|作成|
|TASK-004|/tasks/{id}|PUT|更新|
|TASK-005|/tasks/{id}/complete|PATCH|完了|
|MANUAL-001|/manuals|GET|一覧|
|MANUAL-003|/manuals|POST|作成|
|AI-001|/ai/chat|POST|AI相談|
|AI-002|/ai/conversations|GET|履歴|
|AI-USAGE-001|/ai/usage|GET|利用状況|
|REFLECTION-001|/reflections|POST|振り返り|
|SUB-001|/subscription|GET|契約確認|
|ADMIN-001|/admin/dashboard|GET|管理画面|