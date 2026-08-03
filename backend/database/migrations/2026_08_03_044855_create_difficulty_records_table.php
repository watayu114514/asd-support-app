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

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title', 100)
                ->comment('タイトル');

            $table->text('situation')
                ->comment('状況');

            $table->text('feeling')
                ->nullable()
                ->comment('感じたこと');

            $table->unsignedTinyInteger('severity')
                ->default(1)
                ->comment('困りごとの大きさ');

            $table->timestamp('occurred_at')
                ->nullable()
                ->comment('発生日時');

            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('difficulty_records');
    }
};