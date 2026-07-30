# ASD仕事アシスタント 実装タスク一覧

---

# 1. 目的

本ドキュメントは、
ASD仕事アシスタント開発における
実装作業を管理するためのタスク一覧である。


Cursorを利用し、
以下の順番で開発を進める。


設計確認

↓

Backend実装

↓

API確認

↓

Frontend実装

↓

テスト

↓

Commit


---

# 2. 開発フェーズ


|Phase|内容|状態|
|-|-|-|
|Phase0|環境構築|未着手|
|Phase1|MVP開発|未着手|
|Phase2|改善機能|未着手|
|Phase3|収益化|未着手|


---

# Phase0 開発環境構築


# TASK-001

## プロジェクトフォルダ作成


目的:

開発環境を準備する。


作業:

- ASD-Work-Assistant作成
- backend作成
- frontend作成
- docs作成
- docker作成


完了条件:

フォルダ構成完成。


---

# TASK-002

## Docker環境構築


対象:

docker


作業:

- PHP環境
- Laravel環境
- MySQL環境
- Node環境


完了条件:

Docker起動成功。


---

# TASK-003

## Laravelプロジェクト作成


対象:

backend


作業:

- Laravelインストール
- DB接続設定
- Sanctum設定


完了条件:

Laravel起動確認。


---

# TASK-004

## Vueプロジェクト作成


対象:

frontend


作業:

- Vue3作成
- TypeScript設定
- Vite設定
- Tailwind CSS設定


完了条件:

Vue起動確認。


---

# Phase1 MVP開発


# TASK-005

## Database Migration作成


対象:

Database


作成:


- users
- tasks
- manuals
- manual_steps
- ai_conversations
- ai_messages
- ai_usage_logs
- ai_feedbacks
- reflections
- prompt_templates
- subscriptions
- events


完了条件:

Migration成功。


---

# TASK-006

## 認証機能


対象:

users


Backend:

- Register API
- Login API
- Logout API


Frontend:

- Login画面
- Register画面


完了条件:

ユーザー登録・ログイン可能。


---

# TASK-007

## Dashboard作成


対象:

Dashboard


表示:

- 今日のタスク
- AI利用状況
- 最近の手順書


完了条件:

ログイン後表示可能。


---

# TASK-008

## タスク管理機能


対象:

tasks


Backend:

- Task API
- Validation
- Resource


Frontend:

- 一覧
- 作成
- 編集
- 完了
- 削除


完了条件:

CRUD完成。


---

# TASK-009

## 手順書管理機能


対象:

manuals

manual_steps


Backend:

- Manual API


Frontend:

- 一覧
- 詳細
- 作成
- 編集


完了条件:

手順書管理可能。


---

# TASK-010

## AI相談基盤作成


対象:

AI機能


Backend:

- AI Service作成
- OpenAI API接続
- 利用ログ保存


Database:

ai_conversations

ai_messages

ai_usage_logs


完了条件:

AI回答取得可能。


---

# TASK-011

## AI指示分解機能


機能:

曖昧な仕事指示を分解する。


入力例:

資料まとめて


出力:

- 確認事項
- 作業手順
- 次の行動


完了条件:

AI回答表示可能。


---

# TASK-012

## AI優先順位整理


入力例:

仕事が多すぎる


出力:

- 今日やること
- 後回し
- 確認事項


完了条件:

優先順位整理可能。


---

# TASK-013

## AIメール作成


入力:

上司へ確認したい内容


出力:

メール文章


完了条件:

文章生成可能。


---

# TASK-014

## AI履歴機能


対象:

ai_conversations

ai_messages


作業:

- 履歴一覧
- 履歴詳細


完了条件:

過去相談確認可能。


---

# TASK-015

## AI評価機能


対象:

ai_feedbacks


作業:

- Good評価
- Bad評価
- コメント保存


完了条件:

AI品質改善データ取得可能。


---

# Phase2 改善機能


# TASK-016

## 振り返り機能


対象:

reflections


作業:

- 今日できたこと
- 困ったこと
- AI改善提案


完了条件:

日次振り返り可能。


---

# TASK-017

## 通知機能


作業:

- タスク期限通知
- 振り返り通知


完了条件:

通知確認可能。


---

# Phase3 収益化


# TASK-018

## Stripe決済導入


対象:

subscriptions


作業:

- プラン作成
- 決済処理
- Webhook


完了条件:

有料登録可能。


---

# TASK-019

## AI利用制限


作業:


Free:

5回/日


Standard:

30回/日


Pro:

100回/日


完了条件:

プラン別制限可能。


---

# TASK-020

## 管理画面作成


対象:

admin


表示:


- ユーザー数
- AI利用量
- AIコスト
- 売上


完了条件:

運営管理可能。


---

# 3. リリース前タスク


# TASK-021

## セキュリティ確認


確認:


- Authentication
- Authorization
- XSS
- SQL Injection
- CSRF


---

# TASK-022

## テスト実施


対象:


- API
- UI
- AI
- Database


---

# TASK-023

## 本番環境構築


作業:


- VPS設定
- HTTPS設定
- DB設定
- Deploy


---

# TASK-024

## β版公開


確認:


- ユーザー登録可能
- AI利用可能
- 問題なく動作


---

# 4. Cursor実装ルール


各TASK実装時は必ず:


1. 関連設計書確認

2. 既存コード確認

3. 実装

4. テスト

5. Commit


を行う。


---

# 5. MVP完成条件


以下を満たした状態をMVP完成とする。


- ユーザー登録可能
- ログイン可能
- タスク管理可能
- 手順書管理可能
- AI相談可能
- AI利用ログ保存可能
- 本番環境公開可能