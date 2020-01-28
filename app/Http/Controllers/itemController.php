<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Item;
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
        // $items = Item::paginate(10);
        $cities = DB::table("cities")->pluck("city_name","id");
        $categories = Category::with('attributes')->get();

        return view('items.form',compact('cities','categories'));
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
        $item = Item::create([
            'image' => $request->image->store('images'),
            'city' => $request ->city,
            'region' => $request ->region,
            'found_since' => $request ->found_since,
        ]);
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
        //
    }

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
            
        }

        public function getAttributeList(Category $category)
        {
            // dd($category->attributes()->get());
            // return response()->json();
            
        }






























}
