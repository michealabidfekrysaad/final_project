<?php

namespace App\Http\Controllers;

use App\Area;
use App\Attribute;
use App\Category;
use App\City;
use App\Item;
use App\ItemAttributeValue;
use App\Notifications\NotifyReport;
use Auth;
use DB;
use Illuminate\Http\Request;

class itemController2 extends Controller
{
    public function index2Admin()
    {
        $items = Item::with('city')->with('area')->with('user')->with('category')->paginate(2);
        return view('layouts.AdminPanel.ItemsAdmin.index', [
            'items' => $items
        ]);
    }

    public function create2Admin()
    {
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

    public function show2Admin($id)
    {
        $itemAtributeValue = ItemAttributeValue::with("attribute")->with("value")->where("item_id", "=", $id)->get();
        $item = Item::where("id", "=", $id)->first();
        return view('layouts.AdminPanel.ItemsAdmin.show', compact('item', 'itemAtributeValue'));
    }

    public function edit2Admin(Request $request, $id)
    {
        $item = Item::find($id);
        $city = City::all();
        $area = Area::all()->where('city_id', '=', $item->city_id);
        $category = Category::all();
        $attributes = Category::with('attributes')->where('id', '=', $item->category_id)->get();
        $values = Attribute::with('valuesOfAttributes')->get();
        return view('layouts.AdminPanel.ItemsAdmin.edit', compact('item'
            , 'city', 'area', 'category', 'attributes', 'values'));
    }

    public function update2Admin(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $item = Item::where('id', '=', $id)->first();
            $item->city_id = $request->city_id;
            $item->area_id = $request->area_id;
            $item->found_since = $request->found_since;
            $item->category_id = $request->category_id;
            $item->image = $this->uploadImageToS3('items/', $request->file('image'));
            $item->save();
            $item_attribute_values = ItemAttributeValue::where('item_id', '=', $item->id);
            $item_attribute_values->each(function ($collection, $alphabet) {
                $collection->delete();
            });
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

    public function delete2Admin($id)
    {
        $item = Item::find($id)->delete();
        return redirect()->route('items.index2Admin');
    }

    public function stores(Request $request)
    {
        DB::transaction(function () use ($request) {
            $item = new Item();
            $item->city_id = $request->input('city_id');
            $item->area_id = $request->input('area_id');
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

    }
}
