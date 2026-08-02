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

            // usersテーブルとの紐付け
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // 年齢
            $table->unsignedInteger('age')
                ->nullable();

            // 職業
            $table->string('occupation', 100)
                ->nullable();

            // ASD診断有無
            $table->boolean('asd_diagnosis')
                ->default(false);

            // 診断日
            $table->date('diagnosis_date')
                ->nullable();

            // 困りごとメモ
            $table->text('difficulty_note')
                ->nullable();

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