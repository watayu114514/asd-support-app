<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IssueRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IssueRecordController extends Controller
{
    /**
     * 困りごと登録
     */
    public function store(Request $request)
    {
        Log::info('ISSUE STORE START', [
            'body' => $request->all(),
            'user_id' => auth()->id(),
        ]);

        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'occurred_at' => [
                'required',
                'date',
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

            'cause' => [
                'nullable',
                'string',
            ],

            'countermeasure' => [
                'nullable',
                'string',
            ],

            'work_scene' => [
                'nullable',
                'string',
                'max:50',
            ],

            'fatigue_level' => [
                'nullable',
                'integer',
                'between:1,5',
            ],

            'stress_level' => [
                'nullable',
                'integer',
                'between:1,5',
            ],

            'severity' => [
                'required',
                'integer',
                'between:1,5',
            ],
        ]);


        Log::info('BEFORE CREATE', [
            'validated' => $validated,
        ]);


        try {

            $issueRecord = IssueRecord::create([
                ...$validated,
                'occurred_at' => date('Y-m-d H:i:s', strtotime($validated['occurred_at'])),
                'user_id' => auth()->id(),
                'is_resolved' => false,
            ]);

        } catch (\Throwable $e) {

            Log::error('ISSUE CREATE ERROR', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            throw $e;
        }


        return response()->json([
            'message' => '困りごとを登録しました',
            'data' => $issueRecord,
        ], 201);
    }

    /**
     * 困りごと一覧取得
     */
    public function index(Request $request)
    {
        dd([
        'user' => auth()->user(),
        'token' => request()->header('Authorization'),
    ]);
        $issueRecords = IssueRecord::with('category')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => $issueRecords,
        ]);
    }

    /**
     * 困りごと詳細取得
     */
    public function show($id)
    {
        $issueRecord = IssueRecord::with('category')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return response()->json([
            'data' => $issueRecord,
        ]);
    }

    /**
     * 困りごと更新
     */
    public function update(Request $request, $id)
    {
        $issueRecord = IssueRecord::where('user_id', auth()->id())
            ->findOrFail($id);


        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'occurred_at' => [
                'required',
                'date',
            ],

            'title' => [
                'required',
                'string',
                'max:50',
            ],

            'situation' => [
                'nullable',
                'string',
            ],

            'feeling' => [
                'nullable',
                'string',
            ],

            'cause' => [
                'nullable',
                'string',
            ],

            'countermeasure' => [
                'nullable',
                'string',
            ],

            'work_scene' => [
                'nullable',
                'string',
                'max:50',
            ],

            'fatigue_level' => [
                'nullable',
                'integer',
                'between:1,5',
            ],

            'stress_level' => [
                'nullable',
                'integer',
                'between:1,5',
            ],

            'severity' => [
                'nullable',
                'integer',
                'between:1,5',
            ],

            'is_resolved' => [
                'boolean',
            ],
        ]);


        $issueRecord->update($validated);


        return response()->json([
            'message' => '困りごとを更新しました',
            'data' => $issueRecord->fresh('category'),
        ]);
    }

    /**
     * 困りごと削除
     */
    public function destroy($id)
    {
        $issueRecord = IssueRecord::where('user_id', auth()->id())
            ->findOrFail($id);


        $issueRecord->delete();


        return response()->json([
            'message' => '困りごとを削除しました',
        ]);
    }
}