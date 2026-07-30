# ASD仕事アシスタント システム構成設計書

---

# 1. システム概要

## 目的

ASD特性を持つユーザーが、
仕事を整理し、自分で行動できる状態を作るための
AI仕事支援Webサービスを構築する。


---

# 2. 全体構成


```text
ユーザー

 ↓

Browser

 ↓

Vue3 + TypeScript
Frontend

 ↓

Laravel API

Backend

 ↓

MySQL Database


Laravel API

 ↓

OpenAI API

AI処理


Laravel API

 ↓

Stripe API

決済処理