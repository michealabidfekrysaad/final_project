<?php

namespace App\Http\Controllers;

use App\Notifications\SendSmsMailToFounder;
use App\Notifications\SendSummaryToUser;
use App\Report;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\User;

class reportController extends Controller
{
    private $renderType;
    private $localArray;
    private $localQuery;
    private $globalImage;


    public function __construct()
    {
        $this->globalImage=" ";
        //        $this->middleware(['role:Admin'])->only('index');
        $this->renderType=" ";
        $this->localArray=array();
        $this->localQuery=" ";
    }
    public function index()
    {
        $reports = Report::all();
        return view('people.find');
       // return view("people.find",['reports'=>$reports]);

    }
    public function myReports()
    {
        $reports = auth()->user()->reports;//Report::paginate(10);
        return view('reports/index', [
            'reports' => $reports,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        return view('people.form',['type'=>$type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request,$type)
    {
        $data = [
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'type' => $type,
            'special_mark' => $request->special_mark,
            'eye_color' => $request->eye_color,
            'hair_color' => $request->hair_color,
            'city' => $request->city,
            'region' => $request->region,
            'location' => $request->location,
            'last_seen_on' => $request->last_seen_on,
            'last_seen_at' => $request->last_seen_at,
            'lost_since' => $request->lost_since,
            'found_since' => $request->found_since,
            'height' => $request->height,
            'weight' => $request->weight,
        ];
        $validateFace = $this->detectFace($request->file('image'));
        if (!$validateFace) {
            return response()->json(['message'=>'No face Found Of More than one Face']);
        } else {
            $response = $this->searchByImage($type, $request->file('image'));
            if ($response == false) {
                $request->session()->put('report', $data);
                $report = Report::create($data);
                $report->image = $this->uploadImageToS3($request->file('image'));
                $report->user_id = auth()->user()->getAuthIdentifier();
                $report->save();
                return response()->json([
                    'message' => 'sorry The person not exist and created report successfully',
                    'your report' => $report
                ]);
            } else {
                \request()->session()->put('report', $data);
                \request()->session()->put('imageReport',$this->uploadImageToS3($request->file('image')));
                auth()->user()->notify(new SendSummaryToUser($response));
                return Redirect::to("/profile");
               // return response()->json(['nearest' => $response]);
            }

                //aceept or reject other report here
//                $otherReport = Report::with('user')->where('image', '=', $resonse)->get();
//                return response()->json(['otherReport'=>$otherReport]);
            }

        }
        //accept other report from auth user
        public function acceptOtherReport(Report $report)
        {
            if(\request()->session()->exists('report')){
                \request()->session()->forget('report');
                \request()->session()->forget('imageReport');
            }
            $otherUser = $report->user;
            $otherUser->notify(new SendSmsMailToFounder($report));
            return Redirect::to("/people/search");


        }
    public function RejectOtherReport(){
        if (\request()->session()->exists('report')) {
            $data=\request()->session()->get('report');
            $report = Report::create($data);
            $report->image =\request()->session()->get('imageReport');
            $report->user_id = auth()->user()->getAuthIdentifier();
            $report->save();
            \request()->session()->forget('report');
            \request()->session()->forget('imageReport');
            return Redirect::to("/people/search");
            //return response()->json($report);
        }
        else{
            return Redirect::to("/people/search/lookfor");
        }
    }
        public function closeReport(Report $report){
        $report->is_found='1';
        $report->save();
//        dd($report);
        return redirect('/');

        }

    public function show(Report $report)
    {
        if(auth()->user()->id==$report->user()->id){
           return response()->json($report);
        }
    }
    public function showReportDetails(Report $report){
        return view('people.personDetails',['report'=>$report]);

    }

    public function edit($id)
    {
        //
    }

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
        if ($report->isClean()) {
            return response()->json('You need to specify a different value to update', 422);
        }
             $report->save();
    }

    public function destroy(Report $report)
    {
        if(auth()->user()->id==$report->user()->id||auth()->user()->hasRole('Admin')){
            $report->delete();
        }
    }


    public function SearchReports(Request $request){
       $nameSearch = $request->input('search');
       $FilterSearch = Report::where('name' , 'like' , '%'.$nameSearch.'%')->get();
       dd($FilterSearch);
    }
    public function getFormSearch(){

        return view('search');
    }

    public function searchReports2(Request $request){
        if($request->has('search')){

        $searchName = $request->input('search');

        $FilterSearch = Report::search($searchName)->get();

        return view('search' , ['FilterSearch'=>$FilterSearch]);

        }else{

            return response()->json('Not Found');
        }
    }
    public function getSearchCheckbox(Request $request){
        if($request->input('locationfilter1')){
            $reports = DB::table('reports')->whereIn('gender', ['male'])
            ->get();
        }else{
            $reports = DB::table('reports')->whereIn('gender', ['female'])
            ->get();
        }
        return response()->json($reports);
    }

    public function action(Request $request){
        if($request->ajax()){
            $query = $request->get('query');
            if($query != ''){
                $data = DB::table('reports')->where('type','=','lost')
                    ->where('name' , 'like' , '%'.$query.'%')
                    ->orWhere('city' , 'like' , '%'.$query.'%')
                    ->orWhere('region' , 'like' , '%'.$query.'%')
                    ->get();
            }
            else{
                $data = DB::table('reports')->where('type','=','lost')->get();
            }
            return $data;
        }
    }
    public function showReport($id){
        $repor = Report::findOrFail($id);
        return view('showReports', ['repor'=>$repor]);
    }
    public function filterCheckbox(Request $request){


    }
    public function doSearchingQuery($request) {
        $globalQuery="SELECT * FROM reports WHERE type='lost' AND ";
        $array=array();
        // {"gender":["male","female"],"city":"Cairo","age":[]}
        $constraints= json_decode($request, true);
        if(count($constraints['gender'])==2){
            $firstGender="'".$constraints['gender'][0]."'";
            $secondGender="'".$constraints['gender'][1]."'";
            $query=" (gender=".$firstGender." OR gender=".$secondGender.")";
            array_push($array,$query);
        }
        if(count($constraints['gender'])==1){
            $gender="'".$constraints['gender'][0]."'";
            $query=" gender=".$gender;
            array_push($array,$query);

        }
        //
        if($constraints['city']){
            if(count($constraints['age']) == 1){
                $city="'".$constraints['city']."'"." AND";

            }
            else{
                $city="'".$constraints['city']."'";
            }
            $query="city=".$city;
            array_push($array,$query);
        }
        if($constraints['age']){
            for($i=0;$i<count($constraints['age']);$i++) {
                if ($constraints['age'][$i] == "below_10_years"){
                    $query="age <= 10";
                    array_push($this->localArray,$query);
                }
                if ($constraints['age'][$i] == "below_20_years"){
                    $query="age <= 20 and age > 10";
                    array_push($this->localArray,$query);
                }
                if ($constraints['age'][$i] == "below_30_years"){
                    $query=" age <= 30 and age > 20 ";
                    array_push($this->localArray,$query);
                }
                if ($constraints['age'][$i] == "other_above_30"){

                    $query=" age > 30";
                    array_push($this->localArray,$query);
                }
            }
            for ($i=0;$i<count($this->localArray);$i++){
                if($i > 0){
                    if($i==count($this->localArray) - 1){
                        $this->localQuery .= " OR ".$this->localArray[$i]." )";
                    }
                    else{
                        $this->localQuery .= " OR ".$this->localArray[$i];
                    }
                }
                else
                {
                    if(count($this->localArray)==1){
                        $this->localQuery.=" (".$this->localArray[$i]." )";
                    }
                    else{
                        if($constraints['city']){
                            $this->localQuery.=" AND (".$this->localArray[$i];
                        }
                        else{
                            $this->localQuery.=" (".$this->localArray[$i];
                        }
                    }
                }
            }
            array_push($array,$this->localQuery);
            //return $this->localQuery;
        }

        for($i=0;$i<count($array);$i++){
            if($i==1){
                $globalQuery.=" AND ".$array[$i];
            }
            else{
                $globalQuery.=$array[$i];
            }
        }
         //return $globalQuery;
         return $results = DB::select($globalQuery);
    }
}
