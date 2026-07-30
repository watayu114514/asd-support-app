# ASD仕事アシスタント Cursor開発指示書

---

# 1. 目的

このドキュメントは、
Cursor AIを利用して開発する際の
実装ルール・判断基準を定義する。


Cursorは本プロジェクトの開発補助者として、
既存設計を守りながら実装を行う。


---

# 2. プロジェクト概要


サービス名:

ASD Work Assistant


目的:

ASD特性を持つ人が、
仕事の整理・優先順位付け・手順化を行える
AI仕事支援サービス。


技術構成:


Backend:

- Laravel
- PHP
- MySQL


Frontend:

- Vue3
- TypeScript
- Vite
- Pinia
- Tailwind CSS


AI:

- OpenAI API


---

# 3. 開発基本ルール


## 最優先事項


以下を必ず守る。


1. 既存設計を変更しない
2. シンプルな実装を優先する
3. 保守性を重視する
4. セキュリティを考慮する
5. 不明点は勝手に判断しない


---

# 4. 実装前ルール


コードを書く前に必ず確認する。


確認項目:


- 関連ファイル
- DB構造
- API設計
- 既存Component
- 命名規則


---

# 5. Laravel実装ルール


## Controller


役割:


- Request受付
- Service呼び出し
- Response返却


禁止:


Controller内に業務ロジックを書く。


---

## Service


利用する場所:


- AI処理
- 複雑な業務処理
- 外部API連携


---

## Request


入力チェックは必ずFormRequestを利用する。


例:


TaskCreateRequest


---

## Resource


APIレスポンスはResourceで整形する。


---

# 6. Laravel構成


推奨:


```text
app

├── Http
│
│ ├── Controllers
│ ├── Requests
│ └── Resources
│
├── Models
│
├── Services
│
└── AI