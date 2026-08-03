<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => '仕事ミス',
                'sort' => 1,
            ],
            [
                'name' => '予定変更',
                'sort' => 2,
            ],
            [
                'name' => 'コミュニケーション',
                'sort' => 3,
            ],
            [
                'name' => '集中',
                'sort' => 4,
            ],
            [
                'name' => '感覚過敏',
                'sort' => 5,
            ],
            [
                'name' => '疲労',
                'sort' => 6,
            ],
            [
                'name' => 'その他',
                'sort' => 7,
            ],
        ]);
    }
}