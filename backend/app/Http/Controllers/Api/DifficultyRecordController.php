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
        $records = $request->user()
            ->difficultyRecords()
            ->latest()
            ->get();

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
            'data' => $record
        ]);
    }


    /**
     * 登録
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
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


        $record = $request->user()
            ->difficultyRecords()
            ->create($validated);


        return response()->json([
            'success' => true,
            'data' => $record
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