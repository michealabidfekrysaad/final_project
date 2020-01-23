<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class reportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
{
    $this->middleware(['role:Admin'])->only('index');

}

    public function index()
    {
        $reports = Report::paginate(10);
        return view('reports/index', [
            'reports' => $reports,
        ]);
    }

    public function myReports()
    {
        $reports = auth()->user()->reports ;//Report::paginate(10);
        return view('reports/index', [
            'reports' => $reports,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {
            $report = Report::create([
                'name' => $request->name,
                'age' => $request->age,
                'gender' => $request->gender,
                'image' => $request->image->store('images'),
                'type' => $request ->type,
                'special_mark' => $request ->special_mark,
                'eye_color' => $request ->eye_color,
                'hair_color' => $request ->hair_color,
                'city' => $request ->city,
                'region' => $request ->region,
                'location' => $request ->loaction,
                'last_seen_on' => $request ->last_seen_on,
                'last_seen_at' => $request ->last_seen_at,
                'lost_since' => $request ->lost_since,
                'found_since' => $request ->found_since,
                'height' => $request ->height,
                'weight' => $request ->weight,
            ]);
            return response()->json($report);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        if(auth()->user()->id==$report->user()->id){
           return response()->json($report);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        
            
                if($request->has('name')){
                    $report->name = $request->name;
                }
                if($request->has('age')){
                    $report->age = $request->age;
                }
                if($request->has('gender')){
                    $report->gender = $request->gender;
                }
                if($request->hasFile('image')){
                    Storage::delete($report->image);
                    $report->image = $request->image;
                }
                if($request->has('type')){
                    $report->type = $request->type;
                }
                if($request->has('special_mark')){
                    $report->special_mark = $request->special_mark;
                }
                if($request->has('eye_color')){
                    $report->eye_color = $request->eye_color;
                }
                if($request->has('hair_color')){
                    $report->hair_color = $request->hair_color;
                }
                if($request->has('city')){
                    $report->city = $request->city;
                }
                if($request->has('region')){
                    $report->region = $request->region;
                }
                if($request->has('location')){
                    $report->location = $request->location;
                }
                if($request->has('last_seen_on')){
                    $report->last_seen_on = $request->last_seen_on;
                }
                if($request->has('last_seen_at')){
                    $report->last_seen_at = $request->last_seen_at;
                }
                if($request->has('lost_since')){
                    $report->lost_since = $request->lost_since;
                }
                if($request->has('found_since')){
                    $report->found_since = $request->found_since;
                }
                if($request->has('height')){
                    $report->height = $request->height;
                }
                if($request->has('weight')){
                    $report->weight = $request->weight;
                }
             $report->save();
            
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        if(auth()->user()->id==$report->user()->id||auth()->user()->hasRole('Admin')){
            $report->delete(); 
        }
        
    }
}
