<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\AttributeValue;
use App\ItemAttributeValue;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
use Illuminate\View\View;

class itemController extends Controller
{
    private $itemWithVal;

    public function __construct()
    {
        $this->itemWithVal = "";
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    // isthere any role?
    public function index()
    {
        $categories = Category::all();
        $cities = City::all();
        return view('items.find', [
            'categories' => $categories,
            'cities' => $cities,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $items = Item::paginate(10);
        $categories = Category::all();
        $cities = City::all();
        // return view('item.find');
        return view('items.form', [
            'items' => $items,
            'categories' => $categories,
            'cities' => $cities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
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
        return Redirect::to("/items/search");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function show($item)
    {
        $itemAtributeValue = ItemAttributeValue::with("attribute")->with("value")->where("item_id", "=", $item)->get();
        $item = Item::where("id", "=", $item)->first();
        return view('items.itemDetails', [
            'item' => $item,
            'data' => $itemAtributeValue,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function edit($item)
    {
        //you may put in transaction
        $categories=Category::all();
        $cities=City::all();
        $itemAtributeValue = ItemAttributeValue::with("attribute")->with("value")->where("item_id", "=", $item)->get();
        $attributesIds=array();
        foreach ($itemAtributeValue as $key => $collection){
                array_push($attributesIds,$collection->attribute->id);
        }
        $globalAttributeValues=Attribute::with("values")->wherein("id",$attributesIds)->get();
        $item=Item::find($item);
//       return \response()->json($globalAttributeValues->values);
        return view('user.editItemReport', [
            'categories'=>$categories,
            'item' => $item,
            'data' => $itemAtributeValue,
            'cities'=>$cities,
            'globalAttributeValues'=>$globalAttributeValues
        ]);
    }

    //

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Item $item)
    {
        dd($request->all());
        if (auth()->user()->id == $item->user->id) {
            if ($request->has('city')) {
                $item->city = $request->city;
            }
            if ($request->has('region')) {
                $item->region = $request->region;
            }
            if ($request->has('found_since')) {
                $item->found_since = $request->found_since;
            }
            if ($request->hasFile('image')) {
                $this->deleteImageFromS3($item->image);
                $item->image = $this->uploadImageToS3("items/", $request->file('image'));
            }
            if ($item->isClean()) {
                return response()->json('You need to specify a different value to update', 422);
            }
            $item->save();
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
            return redirect(route('profile.index'));
        }
        else
            return $this->errorResponse("Unauthorize", 403);
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
        $output = '<option value="">Select ' . ucfirst($dependent) . '</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->$dependent . '">' . $row->$dependent . '</option>';
        }
        echo $output;
    }


    // ---------end of ajax for city

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Item $item)
    {
        if (auth()->user()->id == $item->user->id || auth()->user()->hasRole('Admin')) {
            $this->deleteImageFromS3($item->image);
            $item->delete();
            return redirect(route('profile.index'));
        }
    }


    public function getAreaList(Request $request)
    {
        if (app()->getLocale() == 'ar') {
            $states = DB::table("areas")
                ->where("city_id", $request->city_id)
                ->pluck("area_name_ar", "id");
            return response()->json($states);
        } else {
            $states = DB::table("areas")
                ->where("city_id", $request->city_id)
                ->pluck("area_name", "id");
            return response()->json($states);
        }

        // $area = City::with('areas')->where('id' , '=' , $id)->get();
        // foreach($area as $a){
        //     return response()->json($a);
        // }
    }

    public function CityCategory()
    {

        // $cities = DB::table("cities")->pluck("city_name","id");
        $cities = City::all();
        $categories = Category::with('attributes')->get();
        return view('items.form', compact('cities', 'categories'));
    }

    public function getAttributeList($id)
    {
        $category = Category::with('attributes')->where('id', '=', $id)->get();
        return response()->json($category);

    }

    public function getAttributeValue($id)
    {
        $attribute = AttributeValue::with('attribute')->where('attribute_id', '=', $id)->get();
        return response()->json($attribute);


    }

    public function actionItem(Request $request)
    {

        if ($request->ajax()) {
            $query = $request->get('query');
            if ($query != '') {
                $category = Category::with("items")->where('category_name', 'like', '%' . $query . '%')->first();
                if ($category) {
                    return $category->items;
                }
                else return [];
            }
            else {
                return Item::with("category")->get();
            }



            // echo json_encode($data);

        }
    }

    public function showReportItems($id)
    {
        //$item = Item::findOrFail($id);
        $item = Item::with('category')->where('id', '=', $id)->get();

        // $founder = Report::with('user')->where('id' , '=' , $id)->get('user_id');
        // dd($founder);
        return view('items.itemDetails', ['item' => $item]);
    }

    public function sendEmailVerifyItems(Request $request, $id)
    {
        $item = Item::with('user')->where('id', '=', $id)->first();
        $descriptionValidation=new DescriptionValidation();
        $descriptionValidation->lost_id=auth()->user()->id;
        $descriptionValidation->founder_id=$item->user->id;
            $descriptionValidation-> description=$request->input('description');
            $descriptionValidation->item_id=$item->id;
        $descriptionValidation->save();
        Mail::to($item->user->email)->send(new \App\Mail\NotifyItem($item,$descriptionValidation));
      //  $item->user->notify(new NotifyItem($item,$descriptionValidation));
        $item->update(["status"=>1]);
        return redirect('/');
    }

    public function AcceptMessage($decision,DescriptionValidation $descriptionValidation)
    {


        $value='';
        if($decision=="accept")
            $value='1';
            else if($decision=="reject")
                $value='0';
        DB::transaction(function () use ($value,$descriptionValidation) {
            $descriptionValidation->update(['status' => $value]);
            $item = Item::where("id", "=", $descriptionValidation->item_id)->first();
            $item->status=1;
            $item->save();
        });
        return redirect('/')->with("message","Thank you for using our App");
    }

    public function doSearchingQuery($data)
    {
        //put in transaction
        $dataObject = json_decode($data, true);
        $constraints = (array) $dataObject;
        $query = Item::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != "" && !is_array($constraint)) {
                $query = $query->with("category")->where($fields[$index], '=',$constraint);
            }
            $index++;
        }
        if(count($constraints['value_id'])==0)
            return response()->json($query->get());
        else{
            $results=array();
            $itemsIds=$query->pluck('id');
            $values=$constraints['value_id'];
            $result=DB::table('_item_attribute_values')->whereIn('item_id', $itemsIds)->where(function ($q) use($values) {
                    $q->wherein("value_id", $values);
            })->get()->groupBy("item_id");
            foreach ($result as $key => $collection){
                if (count($collection)==count($values)){
                    array_push($results,$key);
                }
            }
            return response()->json(Item::with("category")->whereIn("id",$results)->get());
        }
    }

}
