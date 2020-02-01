<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Report;
use Illuminate\Support\Facades\DB;

class chartsController extends Controller
{ 
    public function index(){
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

    return view('layouts/AdminPanel/chartindex',[
        'type'=> json_encode( $array),
        'is_found'=> json_encode($array1)
        
    ]);
}
}
