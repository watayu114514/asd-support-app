<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DifficultyRecord;

class DifficultyRecordController extends Controller
{
    /**
     * 一覧取得
     */
    public function index(Request $request)
    {

        $query = $request->user()
            ->difficultyRecords();

        // 並び替え
        switch ($request->sort) {
            case 'oldest':
                $query->orderBy('occurred_at', 'asc')
                ->orderBy('created_at', 'desc');
                break;

            case 'severity_desc':
                $query->orderBy('severity', 'desc');
                break;

            case 'severity_asc':
                $query->orderBy('severity', 'asc');
                break;

            default:
                $query->orderBy('occurred_at', 'desc')
                ->orderBy('created_at', 'desc');
                break;
        }

        // キーワード検索
        if ($request->filled('keyword')) {

            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {

                $q->where('title', 'like', "%{$keyword}%")
                ->orWhere('situation', 'like', "%{$keyword}%");

            });

        }

        // 困難度フィルター
        if ($request->filled('severity')) {

            $query->where(
                'severity',
                '>=',
                $request->severity
            );

        }

        //  カテゴリ
        if ($request->filled('category_id')) {

            $query->where(
                'category_id',
                $request->category_id
            );

        }

        // 発生日時期間フィルター
        if ($request->filled('from')) {

            $query->where(
                'occurred_at',
                '>=',
                $request->from . ' 00:00:00'
            );

        }


        if ($request->filled('to')) {

            $query->where(
                'occurred_at',
                '<=',
                $request->to . ' 23:59:59'
            );

        }

        $records = $query->with('category')->get();

        return response()->json([
            'success' => true,
            'data' => $records
        ]);
    }

    /**
     * 詳細取得
     */
    public function show(Request $request, $id)
    {
        $record = $request->user()
            ->difficultyRecords()
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $record->load('category')
        ]);
    }


    /**
     * 登録
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'title' => [
                'required',
                'string',
                'max:50',
            ],
            'situation' => [
                'required',
                'string',
                'max:500',
            ],
            'feeling' => [
                'nullable',
                'string',
                'max:500',
            ],
            'severity' => [
                'required',
                'integer',
                'between:1,5'
            ],
            'occurred_at' => [
                'required',
                'date'
            ],
        ]);

        $record = $request->user()
            ->difficultyRecords()
            ->create($validated);


        return response()->json([
            'success' => true,
            'data' => $record->load('category')
        ]);
    }


    /**
     * 更新
     */
    public function update(Request $request, $id)
    {
        $record = $request->user()
            ->difficultyRecords()
            ->findOrFail($id);


        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'title' => [
                'required',
                'max:100'
            ],
            'situation' => [
                'required'
            ],
            'feeling' => [
                'nullable'
            ],
            'severity' => [
                'required',
                'integer',
                'between:1,5'
            ],
            'occurred_at' => [
                'nullable',
                'date'
            ],
        ]);


        $record->update($validated);


        return response()->json([
            'success' => true,
            'data' => $record
        ]);
    }


    /**
     * 削除
     */
    public function destroy(Request $request, $id)
    {
        $record = $request->user()
            ->difficultyRecords()
            ->findOrFail($id);


        $record->delete();


        return response()->json([
            'success' => true,
            'message' => '削除しました'
        ]);
    }
}