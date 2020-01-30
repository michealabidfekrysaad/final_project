<?php

namespace App\Http\Controllers;

use App\Category;
use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NotifyReport;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\DescriptionValidation;
use App\Item;
use Carbon\Carbon;
use DB;

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
        return view('user.index', [
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
        $cities = DB::table("cities")->pluck("city_name", "id");
        // return view('people.form', compact('cities'));
        return view('people.form',['type'=>$type,'cities'=>$cities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { $type='lost';
        if($type=='lost'){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:8|max:11',
            'age' =>'required|min:1|max:90',
            'gender' => 'required',
            'image' =>'required|mimes:jpeg,jpg,png|max:2024',
            'special_mark' => 'required',
            'eye_color' => 'required',
            'hair_color' => 'required',
            'location' => 'required',
            'last_seen_on' => 'required',
            'last_seen_at' => 'required',
            'lost_since' => 'required|date',
            'height' => 'required|min:50|max:250',
            'weight' => 'required|min:1|max:100',
        ]);
    }
    else{
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:8',
            'age' => 'required|min:1|max:90',
            'gender' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:2024',
            'special_mark' => 'required',
            'eye_color' => 'required',
            'hair_color' => 'required',
            'location' => 'required',
            'found_since' => 'required|date',
            'height' => 'required|min:50|max:250',
            'weight' => 'required|min:1|max:100',
        ]);
    }
        {
            $report = Report::create([
                'name' => $request->name,
                'age' => $request->age,
                'gender' => $request->gender,
                'image' => $request->image,
                'type' =>$type,
                'special_mark' => $request ->special_mark,
                'eye_color' => $request ->eye_color,
                'hair_color' => $request ->hair_color,
                'city' => $request ->city,
                'region' => $request ->region,
                'location' => $request ->location,
                'last_seen_on' => $request ->last_seen_on,
                'last_seen_at' => $request ->last_seen_at,
                'lost_since' => $request ->lost_since,
                'found_since' => $request ->found_since,
                'height' => $request ->height,
                'weight' => $request ->weight,
                'deleted_at' => $request ->deleted_at,
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
     * Show the form for editing the specified resource.o
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::find($id);
        
        return view('user.editReport' ,['report' => $report]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $report = Report::find($id);
        // dd($repo);
        // $repo->name = $request->input('name');
        // $repo->age = $request->input('age');
        // $repo->gender = $request->input('gender');
        // $repo->image = $request->input('image');
        // $repo->type = $request->input('type');
        // $repo->special_mark = $request->input('special_mark');
        // $repo->eye_color = $request->input('eye_color');
        // $repo->hair_color = $request->input('hair_color');
        // $repo->city = $request->input('city');
        // $repo->location = $request->input('location');
        // $repo->last_seen_on = $request->input('last_seen_on');
        // $repo->last_seen_at = $request->input('last_seen_at');
        // $repo->lost_since = $request->input('lost_since');
        // $repo->found_since = $request->input('found_since');
        // $repo->is_found = $request->input('is_found');
        // $repo->height = $request->input('height');
        // $repo->weight = $request->input('weight');
        // $repo->name = auth()->user()->id;

        // $repo->save();
        // return redirect(route('profile.index'));



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
             return redirect(route('profile.index'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        // if(auth()->user()->id==$report->user()->id||auth()->user()->hasRole('Admin')){
        //     $report->delete();
        //     return response()->json($report);
        // }
        $report->delete();
        return response()->json($report);

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
        // $output = '';
        if($request->ajax()){
            $query = $request->get('query');
            if($query != ''){
                $data = DB::table('reports')
                    ->where('name' , 'like' , '%'.$query.'%')
                    ->orWhere('city' , 'like' , '%'.$query.'%')
                    ->orWhere('region' , 'like' , '%'.$query.'%')
                    ->get();
            }
            else{
                $data = DB::table('reports')->get();
            }
            $total_row = $data->count();
            if($total_row > 0 ){
                
                // foreach($data as $row){
                //     $output .= '
                //     <div class="col-lg-4 col-md-6">
				// 			<div class="hotel text-center">
				// 				<a href="{{ url(/showRepo/'.$row->id.') }}">
				// 					<div class="hotel-img">
				// 						<img src="'.$row->image.'" alt="Img Of Person" class="img-fluid">
				// 					</div>

				// 					<h3><a href="{{ url(/showRepo/'.$row->id.') }}">'.$row->name.'</a></h3>

				// 					<p>'.$row->created_at.'</p>
				// 				</a>
				// 			</div>
				// 		</div>  
                        
                //     ';
                // }
            }else{
                $output = '
                   
                        <div align="center" colspan="5">No Data Found</div>
                    
                ';
            }
            return $data;
            

            $data = array(
                'div_data'  => $output
            );
            echo json_encode($data);
            
        }
        
    }

    public function showReport($id){
        $repor = Report::findOrFail($id);
        // $founder = Report::with('user')->where('id' , '=' , $id)->get('user_id');
        // dd($founder);
        return view('people.personDetails', ['repor'=>$repor]);
    }
   
    public function SendEmailVerify(Request $request , $id){
       // $when = now()->addMinutes(10);
        //$when = Carbon::now()->addSeconds(10);

        $founder = Report::with('user')->where('id' , '=' , $id)->get();
        // $founderss = User::with('reports')->where('id' , '=' , $id)->get();
       // dd($founder->user);
        $loster = auth()->user()->id;
        $desc = new DescriptionValidation;
        // $user1 = User::find(4);
        // $user2 = User::find(1);
        foreach($founder as $f){
            $desc->lost_id = $loster;
            $desc->founder_id = $f->user_id;
            $desc->description = $request->input('description');
            $f->user->notify(new NotifyReport($loster , $f->user));
            // $f->user->notify((new NotifyReport($loster))->delay($when));
            //dd(Notification::send($f, new NotifyReport($loster)));
        }
        
        
        
        //dd($user1->notify(new NotifyReport($user2)));
        $desc->save();
        
        return response()->json($desc);
        
        //dd($founder);
        // $founder = Report::with('user')->where('id' , '=' , );
        // $founder = User::with('reports')->get();
        // foreach($founder as $ff){
        // dd($ff->name);
        // }
    }
    public function sendEmailVerifyItems(Request $request , $id){
        //$user->notify(new NotifyReport);
        // or
        //Notification::send($users , new NotifyReport());//for sending to users not one user
        $founder = Item::with('user')->where('id' , '=' , $id)->get();
        dd($founder);

    }


    public function getAreaList(Request $request)
    {
        $states = DB::table("areas")
        ->where("city_id",$request->city_id)
        ->pluck("area_name","id");
        return response()->json($states);
        
    }




}
