<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attribute;
use App\Item;
use App\City;
use App\Area;
use App\Category;
use App\AttributeValue;
use DB;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

       // $this->middleware('role:Admin')->only('indexAdmin');

    }
    public function index()
    {
        $items = Item::paginate(10);
        $categories = Category::all();
        // $cities = DB::table("cities")->pluck("city_name", "id");
        $cities = City::all();

        $attrributeValue=Attribute::with('valuesofattributes')->get();

        return view('items.find' , ['attrributeValue'=>$attrributeValue ,
            'items' => $items ,
            'categories' => $categories,
            'cities'=>$cities]);
    }

    public function indexAdmin()
    {
        $attrributeValues=Attribute::with('valuesofattributes')->paginate(3);
       // return response()->json($attrributeValues);
        return view('layouts.AdminPanel.attribute.index' , [
            'attrributeValues'=>$attrributeValues ,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('layouts.AdminPanel.attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute =Attribute::create([
            'attribute_name'=>$request->attribute,
            'attribute_name_ar'=>$request->attribute_ar,
    ]);
        for ($i=0;$i<count($request->valueEn);$i++){
            AttributeValue::create([
                'value_name'=>$request->valueEn[$i],
                'value_name_ar'=>$request->valueAr[$i],
                'attribute_id'=>$attribute->id
            ]);
    }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attr = Attribute::find($id);
        return view('attribute.show' , ['attr' => $attr]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attr = Attribute::find($id);
        return view('attribute.edit' , ['attr' => $attr]);
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
        $attr = Attribute::find($id);
        $attr->attribute_name = $request->input('attribute_name');
        $attr->save();
        return redirect(route('attribute.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Attribute::find($id)->delete();
        return redirect()->back();
    }

    public function getAreas($id){
        $areas = Area::where('city_id','=',$id)->get();
        // return view('items.find',['areas'=>$areas]);
        return response()->json($areas);
    }
    public function getAttributeList($id)
    {
        $category = Category::with('attributes')->where('id' , '=' , $id)->get();
        return response()->json($category);

    }

}
