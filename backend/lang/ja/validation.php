<?php

return [

    'required' => ':attributeは必須です。',

    'max' => [
        'string' => ':attributeは:max文字以内で入力してください。',
    ],

    'between' => [
        'numeric' => ':attributeは:min～:maxの範囲で入力してください。',
    ],

    'date' => ':attributeの日付が正しくありません。',

    'attributes' => [
        'title' => 'タイトル',
        'situation' => '状況',
        'feeling' => '感じたこと',
        'severity' => '困難度',
        'occurred_at' => '発生日時',
    ],

];