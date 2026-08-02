<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * プロフィール取得
     */
    public function show(Request $request)
    {
        $profile = $request->user()->profile;

        return response()->json([
            'success' => true,
            'data' => $profile,
        ]);
    }


    /**
     * プロフィール登録
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'age' => [
                'nullable',
                'integer',
                'min:0',
            ],
            'occupation' => [
                'nullable',
                'string',
                'max:100',
            ],
            'asd_diagnosis' => [
                'boolean',
            ],
            'diagnosis_date' => [
                'nullable',
                'date',
            ],
            'difficulty_note' => [
                'nullable',
                'string',
            ],
        ]);

        $profile = $request->user()
            ->profile()
            ->create($validated);

        return response()->json([
            'success' => true,
            'data' => $profile,
        ]);
    }


    /**
     * プロフィール更新
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'age' => [
                'nullable',
                'integer',
                'min:0',
            ],
            'occupation' => [
                'nullable',
                'string',
                'max:100',
            ],
            'asd_diagnosis' => [
                'boolean',
            ],
            'diagnosis_date' => [
                'nullable',
                'date',
            ],
            'difficulty_note' => [
                'nullable',
                'string',
            ],
        ]);

        $profile = $request->user()->profile;

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'プロフィールが存在しません。',
            ], 404);
        }

        $profile->update($validated);

        return response()->json([
            'success' => true,
            'data' => $profile,
        ]);
    }
}