<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use DB;
use App\User;

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
    public function doSearchingQuery() {
        return '00';

        $constraints = [
            'gender' => 'hhh',
            'city' => 'jhhh'
        
        ];
        $query = User::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                if(count($constraint)>1){
                    foreach ($constraint as $one)
                    {
                        $query = $query->where($constraint, 'like', '%'.$one.'%');
                    }
                }
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }
            $index++;
        }
        return $query->paginate(5);
    }
}
