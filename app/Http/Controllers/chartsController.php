<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Report;
use App\Item;
use Illuminate\Support\Facades\DB;

class chartsController extends Controller
{
    public function index(){
        return view('layouts/AdminPanel/index');
}
public function chart(){
    $data = DB::table('reports')
        ->select(
            DB::raw('type as type'),
            DB::raw('count(*) as number'))
        ->groupBy('type')
        ->get();
    $array [] = ['Type', 'Number'];
    foreach ($data as $key => $value) {
        $array[++$key] = [$value->type, $value->number];
    }
    return [
        'type'=> response()->json($array),
    ];
}
    public function chart1(){
        $data1 = DB::table('reports')
            ->select(
                DB::raw('is_found as is_found'),
                DB::raw('count(*) as number'))
            ->groupBy('is_found')
            ->get();
        $array1 [] = ['is_found', 'Number'];
        foreach ($data1 as $key => $value) {
            $array1[++$key] = [$value->is_found, $value->number];
        }
        return $array1;
        return [
        'is_found'=> response()->json($array1)
        ];
    }
    public function chart2(){
        $data2 = DB::table('items')
            ->select(
                DB::raw('status as status'),
                DB::raw('count(*) as number'))
            ->groupBy('status')
            ->get();
        $array2 [] = ['status', 'Number'];
        foreach ($data2 as $key => $value) {
            $array2[++$key] = [$value->status, $value->number];
        }
        return $array2;
        return [
            'status' => response()->json($array2)
        ];
    }

    public function viewAndClick()
    {
        $viewsArray = array();
        $clicksArray = array();
        $timesArray = array();
        $views = DB::table('visitor')->get(['viewer'])->toArray();
        $clicks = DB::table('visitor')->get(['click'])->toArray();
        $times = DB::table('visitor')
            ->select(DB::raw("DATE_FORMAT(created_at, '%m-%Y') as time"))
            ->orderBy("created_at")
            ->get()->toArray();
        foreach ($views as $view) {
            array_push($viewsArray, $view->viewer);
        }
        foreach ($clicks as $click) {
            array_push($clicksArray, $click->click);
        }
        foreach ($times as $time) {
            array_push($timesArray, $time->time);
        }
        return response()->json([
            'views' => $viewsArray,
            'clicks' => $clicksArray,
            'times' => $timesArray
        ]);
    }
}
