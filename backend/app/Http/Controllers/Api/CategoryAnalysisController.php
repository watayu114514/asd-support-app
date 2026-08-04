<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryAnalysisController extends Controller
{
    public function index(Request $request)
    {

        $categories = Category::withCount([
            'difficultyRecords'
        ])
        ->withAvg([
            'difficultyRecords'
        ], 'severity')
        ->orderBy('sort')
        ->get();


        return response()->json([
            'success' => true,
            'data' => $categories
        ]);

    }
}