<?php

namespace App\Http\Controllers;

use App\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NotifyReport;
use Illuminate\Support\Facades\Notification;
use App\Item;
use App\City;
use App\Area;
use App\DescriptionValidation;
use DB;
use App\Category;
class itemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // isthere any role?
    public function index()
    {
        $items = Item::paginate(10);
       // return view('item.find');
        // return view('items/index', [
        //     'items' => $items,
        // ]);
        // $items = Item::paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('item.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // City::where('id','=',$request->input('city_name'))
        $item = new Item;
        $item->image = $request->input('image');
        $item->category_id = $request->input('category_id');
         $item->city = $request->input('city_name');
        $item->region = $request->input('region');
        $item->found_since = $request->input('found_since');
        $item->user_id = auth()->user()->id;
        dd($request);
        $item->save();
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        if(auth()->user()->id==$item->user->id){
            return response()->json($item);
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
    }

    //
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Item $item)
    {
        if($request->hasFile('image')){
            Storage::delete($item->image);
            $item->image = $request->image;
        }
        if($request->has('city')){
            $item->city = $request->city;
        }
        if($request->has('region')){
            $item->region = $request->region;
        }
        if($request->has('found_since')){    
            $item->found_since = $request->found_since;
        }
        $item->save();
    }

    function fetch(Request $request)
    {
     $select = $request->get('select');
     $value = $request->get('value');
     $dependent = $request->get('dependent');
     $data = DB::table('country_state_city')
       ->where($select, $value)
       ->groupBy($dependent)
       ->get();
     $output = '<option value="">Select '.ucfirst($dependent).'</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
     }
     echo $output;
    }


    // ---------end of ajax for city

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json($item);
    }






        public function getAreaList(Request $request)
        {
            $states = DB::table("areas")
            ->where("city_id",$request->city_id)
            ->pluck("area_name","id");
            return response()->json($states);

            // $area = City::with('areas')->where('id' , '=' , $id)->get();
            // foreach($area as $a){
            //     return response()->json($a);
            // }
        }

        public function CityCategory(){
        
            // $cities = DB::table("cities")->pluck("city_name","id");
            $cities = City::all();
            $categories = Category::with('attributes')->get();
    
            return view('items.form',compact('cities','categories'));
        }

        public function getAttributeList($id)
        {
           $category = Category::with('attributes')->where('id' , '=' , $id)->get();
           return response()->json($category);
            
        }
        
        public function getAttributeValue($id)
        {
           $attribute = AttributeValue::with('attribute')->where('attribute_id','=',$id)->get();
           return response()->json($attribute);
            

        }
        public function actionItem(Request $request){
            // $output = '';
            if($request->ajax()){
                $query = $request->get('query');
                if($query != ''){
                    $data = DB::table('items')
                        ->where('image' , 'like' , '%'.$query.'%')
                        ->get();
                }
                else{
                    $data = DB::table('items')->get();
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

        public function showReportItems($id){
            //$item = Item::findOrFail($id);
            $item = Item::with('category')->where('id' , '=' , $id)->get();
            dd($item);
            // $founder = Report::with('user')->where('id' , '=' , $id)->get('user_id');
            // dd($founder);
            return view('items.itemDetails', ['item'=>$item]);
        }
    public function sendEmailVerifyItems(Request $request , $id){
        //$user->notify(new NotifyReport);
        // or
        //Notification::send($users , new NotifyReport());//for sending to users not one user
        $founder = Item::with('user')->where('id' , '=' , $id)->get();
        dd($founder);

         // $when = now()->addMinutes(10);
        //$when = Carbon::now()->addSeconds(10);

       // $founder = Report::with('user')->where('id' , '=' , $id)->get();
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
            $f->user->notify(new NotifyReport($loster));
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
}
