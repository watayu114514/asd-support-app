<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('difficulty_records', function (Blueprint $table) {
            $table->id();

            // ユーザーID
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // 困りごとのタイトル
            $table->string('title', 100);

            // 状況
            $table->text('situation')
                ->nullable();

            // 感じたこと
            $table->text('feeling')
                ->nullable();

            // つらさレベル 1〜5
            $table->unsignedTinyInteger('severity')
                ->nullable();

            // 発生日時
            $table->date('occurred_at')
                ->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('difficulty_records');
    }
};