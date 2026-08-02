<?php

namespace App\Http\Controllers;

use App\Models\DifficultyRecord;
use Illuminate\Http\Request;

class DifficultyStatisticsController extends Controller
{

    public function index()
    {
        $user = auth()->user();


        $records = 
            $user->difficultyRecords;



        // 困難度別集計

        $severityGraph =

            $records

                ->groupBy('severity')

                ->map(function($items){

                    return $items->count();

                });



        // 月別推移
        $monthlyGraph =

            $records

                ->groupBy(function ($item) {

                    return $item->occurred_at->format('Y-m');

                })

                ->map(function ($items, $month) {

                    return [

                        'month' => $month,

                        'count' => $items->count()

                    ];

                })

                ->values();

        // 曜日別集計
        $weekdayGraph = $records
            ->groupBy(function ($item) {

                return $item->occurred_at
                    ->locale('ja')
                    ->dayName;

            })
            ->map(function ($items, $weekday) {

                return [
                    'weekday' => $weekday,
                    'count' => $items->count()
                ];

            })
            ->values();

        // 時間帯別集計
        $timeGraph = $records
            ->groupBy(function ($item) {

                $hour = $item->occurred_at->hour;


                if ($hour < 12) {

                    return '午前';

                } elseif ($hour < 18) {

                    return '午後';

                } else {

                    return '夜';

                }

            })
            ->map(function ($items, $time) {

                return [

                    'time' => $time,

                    'count' => $items->count()

                ];

            })
            ->values();


        return response()->json([


            // 件数

            'count' =>

                $records->count(),



            // 平均困難度

            'averageSeverity' =>

                round(
                    $records->avg('severity'),
                    1
                ),



            // よくある困りごと

            'topTitles' =>


                $records

                ->groupBy('title')

                ->map(function($items,$title){

                    return [

                        'title'=>$title,

                        'count'=>$items->count(),

                        'severity'=>
                            round(
                                $items->avg('severity'),
                                1
                            )

                    ];

                })

                ->sortByDesc('count')

                ->values(),



            // 困難度グラフ

            'severityGraph' =>

                $severityGraph,



            // 月別推移
            'monthlyGraph' =>

                $monthlyGraph,

            // 曜日別推移
            'weekdayGraph' =>

                $weekdayGraph,


            // 時間帯別
            'timeGraph' =>

                $timeGraph

        ]);
    }

}