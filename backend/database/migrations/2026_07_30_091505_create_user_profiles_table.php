<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
        ->constrained()
        ->cascadeOnDelete();

    // 基本情報
    $table->unsignedInteger('age')
        ->nullable()
        ->comment('年齢');

    $table->string('occupation', 100)
        ->nullable()
        ->comment('職業');

    // 診断情報
    $table->unsignedTinyInteger('diagnosis_status')
        ->default(0)
        ->comment('診断状況');

    $table->date('diagnosis_date')
        ->nullable()
        ->comment('診断日');

    // ASD特性
    $table->text('strengths')
        ->nullable()
        ->comment('得意なこと');

    $table->text('weaknesses')
        ->nullable()
        ->comment('苦手なこと');

    // メモ
    $table->text('difficulty_note')
        ->nullable()
        ->comment('困りごとメモ');

    $table->text('memo')
        ->nullable()
        ->comment('その他メモ');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};