# ASD仕事アシスタント データベース設計書

## 1. データベース概要

## Database

MySQL

## 命名規則

- テーブル名：snake_case複数形
- カラム名：snake_case
- 主キー：id
- 外部キー：xxx_id
- 作成日時：created_at
- 更新日時：updated_at


---

# 2. ER図

users
 |
 | 1
 |
 | N
tasks


users
 |
 | 1
 |
 | N
manuals
 |
 | 1
 |
 | N
manual_steps


users
 |
 | 1
 |
 | N
ai_conversations
 |
 | 1
 |
 | N
ai_messages


ai_conversations
 |
 | 1
 |
 | N
ai_feedbacks


users
 |
 | 1
 |
 | N
ai_usage_logs


users
 |
 | 1
 |
 | N
events


users
 |
 | 1
 |
 | N
subscriptions


users
 |
 | 1
 |
 | N
reflections


prompt_templates


---

# 3. users

## 目的

ユーザー情報を管理する。


|カラム|型|説明|
|-|-|-|
|id|bigint|ID|
|name|string|名前|
|email|string|メールアドレス|
|password|string|パスワード|
|role|string|権限|
|created_at|timestamp|作成日時|
|updated_at|timestamp|更新日時|


role:

user

admin

support


---

# 4. tasks

## 目的

ユーザーの仕事タスクを管理する。


|カラム|型|説明|
|-|-|-|
|id|bigint|ID|
|user_id|bigint|ユーザーID|
|title|string|タイトル|
|description|text|詳細|
|priority|string|優先度|
|status|string|状態|
|due_date|date|期限|
|created_at|timestamp|作成日時|
|updated_at|timestamp|更新日時|


priority:

low

normal

high


status:

todo

doing

done


---

# 5. manuals

## 目的

仕事手順書を管理する。


|カラム|型|説明|
|-|-|-|
|id|bigint|ID|
|user_id|bigint|ユーザーID|
|title|string|タイトル|
|description|text|説明|
|created_at|timestamp|作成日時|
|updated_at|timestamp|更新日時|


---

# 6. manual_steps

## 目的

手順書のステップを管理する。


|カラム|型|説明|
|-|-|-|
|id|bigint|ID|
|manual_id|bigint|手順書ID|
|step_number|int|順番|
|content|text|内容|
|is_completed|boolean|完了状態|
|created_at|timestamp|作成日時|
|updated_at|timestamp|更新日時|


---

# 7. ai_conversations

## 目的

AI相談単位を管理する。


|カラム|型|説明|
|-|-|-|
|id|bigint|ID|
|user_id|bigint|ユーザーID|
|title|string|相談タイトル|
|feature|string|AI機能|
|created_at|timestamp|作成日時|
|updated_at|timestamp|更新日時|


feature:

task_division

priority_analysis

mail_create

consultation

reflection


---

# 8. ai_messages

## 目的

AIとの会話内容を保存する。


|カラム|型|説明|
|-|-|-|
|id|bigint|ID|
|conversation_id|bigint|AI相談ID|
|role|string|発言者|
|content|text|内容|
|created_at|timestamp|作成日時|


role:

user

assistant


---

# 9. ai_usage_logs

## 目的

AI利用量とコストを管理する。


|カラム|型|説明|
|-|-|-|
|id|bigint|ID|
|user_id|bigint|ユーザーID|
|feature|string|AI機能|
|model|string|利用モデル|
|prompt_tokens|int|入力Token|
|completion_tokens|int|出力Token|
|total_tokens|int|総Token|
|cost|decimal|利用料金|
|created_at|timestamp|利用日時|


---

# 10. ai_feedbacks

## 目的

AI回答への評価を管理する。


|カラム|型|説明|
|-|-|-|
|id|bigint|ID|
|user_id|bigint|ユーザーID|
|conversation_id|bigint|AI相談ID|
|rating|string|評価|
|comment|text|コメント|
|created_at|timestamp|作成日時|


rating:

good

bad


---

# 11. reflections

## 目的

仕事の振り返りを管理する。


|カラム|型|説明|
|-|-|-|
|id|bigint|ID|
|user_id|bigint|ユーザーID|
|completed_today|text|できたこと|
|problem|text|困ったこと|
|ai_advice|text|AI改善提案|
|created_at|timestamp|作成日時|
|updated_at|timestamp|更新日時|


---

# 12. prompt_templates

## 目的

AIプロンプトを管理する。


|カラム|型|説明|
|-|-|-|
|id|bigint|ID|
|name|string|名称|
|feature|string|対象機能|
|system_prompt|text|システムプロンプト|
|version|string|バージョン|
|is_active|boolean|有効状態|
|created_at|timestamp|作成日時|
|updated_at|timestamp|更新日時|


---

# 13. subscriptions

## 目的

有料プラン契約を管理する。


|カラム|型|説明|
|-|-|-|
|id|bigint|ID|
|user_id|bigint|ユーザーID|
|stripe_customer_id|string|Stripe顧客ID|
|stripe_subscription_id|string|Stripe契約ID|
|plan|string|プラン|
|status|string|契約状態|
|started_at|timestamp|開始日時|
|ended_at|timestamp|終了日時|
|created_at|timestamp|作成日時|
|updated_at|timestamp|更新日時|


plan:

free

standard

pro


---

# 14. events

## 目的

ユーザー行動ログを保存する。


|カラム|型|説明|
|-|-|-|
|id|bigint|ID|
|user_id|bigint|ユーザーID|
|event_name|string|イベント名|
|properties|json|詳細情報|
|created_at|timestamp|日時|


event例:

login

task_created

task_completed

ai_requested

subscription_started


---

# 15. Index設定

追加推奨:

users.email

tasks.user_id

manuals.user_id

ai_conversations.user_id

ai_usage_logs.user_id

events.user_id


---

# 16. Migration作成順序

users

tasks

manuals

manual_steps

ai_conversations

ai_messages

ai_feedbacks

ai_usage_logs

reflections

prompt_templates

subscriptions

events