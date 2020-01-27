<?php

namespace App\Http\Controllers;

use App\Notifications\SendSmsMailToFounder;
use App\Report;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\User;

class reportController extends Controller
{

    private $client;
    private $renderType;

    public function __construct()
    {
        $this->renderType=" ";
//        $this->middleware(['role:Admin'])->only('index');
        $this->client = new RekognitionClient(
            [
                'version' => 'latest',
                'region' => 'us-east-2',
                'credentials' => [
                    'key' => 'AKIA5WVDM6FIA5253O7V',
                    'secret' => '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'
                ]]);
    }
    public function index()
    {
        $reports = Report::all();
        return response()->json($reports);

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validateFace = $this->detectFace($request->file('image'));
        if (!$validateFace) {
            return response()->json(['message'=>'No face Found Of More than one Face']);
        } else
        {
            $resonse = $this->searchByImage($request->type,$request->file('image'));
            if ($resonse==false) {
                $data=[
                    'name' => $request->name,
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'type' => $request->type,
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
                $report = Report::create($data);
                $request->session()->put('report',$data);
                $responseFromS3Upload = $this->uploadImageToS3($report, $request->file('image'));
                return response()->json([
                    'message' => 'sorry The person not exist and created report successfully',
                    'your report' => $responseFromS3Upload
                ]);
            }
            else {
                $otherReport = Report::with('user')->where('image', '=', $resonse)->get();
                return response()->json(['otherReport'=>$otherReport]);
            }

        }
        }
        //accept other report from auth user
        public function acceptOtherReport(Report $report)
        {
            \request()->session()->forget('report');
            $otherUser = $report->user;
            $otherUser->notify(new SendSmsMailToFounder($report,User::find(6)));

        }
    public function RejectOtherReport(){
        if (\request()->session()->has('report')) {
            $data=\request()->session()->get('report');
            $report = Report::create($data);
            \request()->session()->forget('report');
            return response()->json($report);
        }
    }
        public function closeReport(Report $report){
        $report->is_found='1';
        $report->save();
        dd($report);
        return redirect('/');

        }

    public function show(Report $report)
    {
        if(auth()->user()->id==$report->user()->id){
           return response()->json($report);
        }
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
    public function detectFace($file){
        {
            $filenamewithextension = $file;
            $result = $this->client->detectFaces([
                'Image' => [
                    'Bytes' => file_get_contents($filenamewithextension,true)
                ],
            ]);
            if (count($result->get('FaceDetails'))==1){
                return true;
            }
//            else if (count($result->get('FaceDetails'))>1){
//                return 'there are more than one person';
//            }
            else{
                return false;
               // return response()->json('there are no person in image');
            }
        }

    }
    public function uploadImageToS3($report,$file){

        $filenamewithextension = $file->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filenametostore = 'people/'.$filename.'_'.time().'.'.$extension;
        Storage::disk('s3')->put($filenametostore, fopen($file, 'r+'), 'public');
       // $image_url='https://loseall.s3.us-east-2.amazonaws.com/'.$filenametostore;
        $report->image= $filenametostore;
        $report->user_id=6;
        $report->save();
        return $report;

    }
    public function searchByImage($type,$file){

        if($type=="lost"){
            $this->renderType="found";
        }
        if($type=="found"){
            $this->renderType="lost";
        }
        foreach (DB::table('reports')->where('type','=',$this->renderType)->get(['image'])->toArray() as $value){
            $result = $this->client->compareFaces([
                'SimilarityThreshold' => 0,
                'SourceImage' => [
                    'Bytes' => file_get_contents($file,true)
                ],
                'TargetImage' => [
                    'S3Object' => [
                        'Bucket' => 'loseall',
                        'Name' => $value->image,
                    ],
                ],

            ]);
            if ((int)$result->get('FaceMatches')[0]['Similarity'] > 90)
            {
                return  $value->image;
            }
        }
        return false;
    }
    public function searchbyImageForLost(Request $request){
        $response= $this->searchByImage('lost',$request->image);
        if($response=false){
            return response()->json('go to report image');
        }
        else{
            $otherReport = Report::with('user')->where('image', '=', $response)->get();
            return response()->json(['otherReport'=>$otherReport]);
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
}
