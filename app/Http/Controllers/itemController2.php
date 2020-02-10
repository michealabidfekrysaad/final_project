<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attribute;
use App\AttributeValue;
use App\ItemAttributeValue;
use DB;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NotifyReport;
use Illuminate\Support\Facades\Notification;
use App\Item;
use App\City;
use App\Area;
use App\User;
use App\DescriptionValidation;
use App\Category;
use App\Notifications\NotifyItem;

class itemController2 extends Controller
{
    public function index2Admin(){
        $items = Item::with('city')->with('area')->with('user')->with('category')->paginate(2);
        // dd($items);
        // $city = Item::with('city')->get();
        // $area = Item::with('area')->get();
        // $user = Item::with('user')->get();
        // $category = Item::with('category')->get();
        
        return view('layouts.AdminPanel.ItemsAdmin.index' , [
          'items' => $items 
        ]);
    }
    public function create2Admin(){
        // $city = City::all();
        // $area = Area::all();
        // $user = User::all();
        // $category = Category::all();
        // $attr = Attribute::all();
        // $value = AttributeValue::all();
        // return view('layouts.AdminPanel.ItemsAdmin.create' , [
        //     'city' => $city 
        //   , 'area' => $area
        //   , 'user' => $user
        //   , 'category' => $category
        //   , 'attr' => $attr
        //   , 'value' => $value
        //   ]);
        $items = Item::paginate(10);
        $categories = Category::all();
        $cities = City::all();
        // return view('item.find');
        return view('layouts.AdminPanel.ItemsAdmin.create', [
            'items' => $items,
            'categories' => $categories,
            'cities' => $cities,
        ]);
    }

    public function show2Admin($id){
        // $item = Item::find($id);
        // $city = City::find($id);
        // $area = Area::find($id);
        // $user = User::find($id);
        // $category = Category::find($id);
        // $attr = Attribute::find($id);
        // $value = AttributeValue::find($id);
        $itemAtributeValue = ItemAttributeValue::with("attribute")->with("value")->where("item_id", "=", $id)->get();
        $item = Item::where("id", "=", $id)->first();
        return view('layouts.AdminPanel.ItemsAdmin.show' , compact('item','itemAtributeValue'));
    }

    public function edit2Admin(Request $request , $id){
        $item = Item::find($id);
        $city = City::all();
        $area = Area::all()->where('city_id','=',$item->city_id);
        $category = Category::all();
        $attributes = Category::with('attributes')->where('id' , '=' , $item->category_id)->get();
        $values = Attribute::with('valuesOfAttributes')->get();


        // $attributeOfCategory = $item->attributes;
        // dd($attributeOfCategory);

        // $city = City::all();
        // $area = Area::all();
        // $user = User::all();
        // $category = Category::all();
        // $attr = Attribute::all();
        // $value = AttributeValue::all();
        return view('layouts.AdminPanel.ItemsAdmin.edit' , compact('item' 
        , 'city','area','category','attributes' , 'values'));
    }
    public function update2Admin(Request $request , $id){
    

        DB::transaction(function() use ($request , $id) {

            $item = Item::where('id' , '=' , $id)->first();
            $item->update([
                'image' => 'aaaa',//$this->uploadImageToS3('items/',$request->file('image')),
                'city_id' => $request->input('city_id'),
                'area_id' => $request->input('area_id'),
                'found_since' => $request->input('found_since'),   
                'category_id' => $request->input('category_id')
            ]);
            $item_attribute_values=ItemAttributeValue::whereIn('item_id',[$item->id])->delete();
            dd($item_attribute_values);
           foreach ($request->all() as $attribute => $value) {
                if ($this->startsWith($attribute, "#")) {
                    $this->itemWithVal = DB::table("_item_attribute_values")->insert([
                        'item_id' => $item->id,
                        'attribute_id' => (Attribute::where('attribute_name', '=', substr($attribute, 1))->first())->id,
                        'value_id' => $value
                    ]);
                }
            } 
            
  });
  return redirect()->route('items.index2Admin');
  
    }

    public function delete2Admin($id){
        $item = Item::find($id)->delete();
        return redirect()->route('items.index2Admin');
    }

    public function stores(Request $request){
        DB::transaction(function () use ($request) {
            $item = new Item();
            $item->city_id = $request->input('city_id');
            $item->area_id = 1;
            $item->image = $this->uploadImageToS3("items/", $request->file('image'));
            $item->category_id = $request->input('category_id');
            $item->found_since = $request->input('found_since');
            $item->user_id = auth()->user()->id;
            $item->save();
            foreach ($request->all() as $attribute => $value) {
                if ($this->startsWith($attribute, "#")) {
                    $this->itemWithVal = DB::table("_item_attribute_values")->insert([
                        'item_id' => $item->id,
                        'attribute_id' => (Attribute::where('attribute_name', '=', substr($attribute, 1))->first())->id,
                        'value_id' => $value
                    ]);
                }
            }
        }, 1);
        return redirect()->route('items.index2Admin');
// // dd(auth()->user()->id);
//         DB::transaction(function() use ($request) {
//             $item = Item::
//             create([
//                 'image' => $this->uploadImageToS3('items/',$request->file('image')),
//                 'found_since' => $request->input('found_since'),
//                 'user_id' => auth()->user()->id,
//                 'category_id' => $request->input('category_id')
//             ]);
//            $item->city_id = $request->input('city_id');
//            $item->area_id = $request->input('area_id');
//            //dd($item);
//             $item->save();
//             $itemAttributeValue = ItemAttributeValue::
//             create([
//                 'attribute_id' => $request->input('attribute_id'),
//                 'value_id' => $request->input('value_id'),
//                  'item_id' => $item->id
//             ]); 
                
//    });
   
//    return redirect()->route('items.index2Admin');

    }
}
