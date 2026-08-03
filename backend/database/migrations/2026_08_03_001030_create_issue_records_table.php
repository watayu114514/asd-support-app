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
        Schema::create('issue_records', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->foreignId('category_id')
    ->constrained()
    ->restrictOnDelete();

    $table->timestamp('occurred_at')
    ->nullable()
    ->comment('発生日時');

    $table->string('title', 150)
        ->comment('タイトル');

    $table->text('situation')
        ->nullable()
        ->comment('状況');

    $table->text('feeling')
        ->nullable()
        ->comment('感じたこと');

    $table->text('cause')
        ->nullable()
        ->comment('原因');

    $table->text('countermeasure')
        ->nullable()
        ->comment('対策');

    $table->string('work_scene', 50)
        ->nullable()
        ->comment('仕事の場面');

    $table->unsignedTinyInteger('fatigue_level')
    ->default(1)
    ->comment('疲労度 1〜5');

    $table->unsignedTinyInteger('stress_level')
    ->default(1)
    ->comment('ストレス度');

    $table->unsignedTinyInteger('severity')
        ->default(1)
        ->comment('困りごとの大きさ');

    $table->boolean('is_resolved')
        ->default(false)
        ->comment('解決済み');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_records');
    }
};
