<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use DB;

class filterController extends Controller
{
    public function index(){
      $data = Report::GetFilter();
      return response()->json($data->toArray());
    }

    public function filterSearch(Request $request){
    //    if($request->has('male')){
    //     $reports = DB::table('reports')
    //     ->select('*')
    //     ->where('gender' , 'male')
    //     ->get();

    //    }
    //    if($request->has('below_10_years')){
    //     $reports = DB::table('reports')
    //     ->select('*')
    //     ->where('age' , '<' , 10)
    //     ->get();

    //    }

    $reports = Report::where('gender' , 'male')
            ->get();



            // $reports = DB::table('reports')->whereIn('gender', ['male'])
            //  ->orWhere('age' , '<' , 10)
            // ->get();
        
        
        return response()->json($reports);
    }
}
