<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\AttributeValue;
use App\ItemAttributeValue;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NotifyReport;
use Illuminate\Support\Facades\Notification;
use App\Item;
use App\City;
use App\Area;
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
        $items = Item::paginate(5);
        $categories = Category::all();
        $cities = City::all();
        return view('items.find', [
            'items' => $items,
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
        //return response()->json( $this->itemWithVal);
        return Redirect::to("/items/search/found");
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
     * @return Response
     */
    public function edit($id)
    {
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
        if ($request->hasFile('image')) {
            Storage::delete($item->image);
            $item->image = $request->image;
        }
        if ($request->has('city')) {
            $item->city = $request->city;
        }
        if ($request->has('region')) {
            $item->region = $request->region;
        }
        if ($request->has('found_since')) {
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
        $item->delete();
        return response()->json($item);
    }


    public function getAreaList(Request $request)
    {
        $states = DB::table("areas")
            ->where("city_id", $request->city_id)
            ->pluck("area_name", "id");
        return response()->json($states);

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
                } else return [];
            } else {
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
        $item->user->notify(new NotifyItem($item,$descriptionValidation));
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
        return redirect('/');
    }

    public function doSearchingQuery($data)
    {
        $dataObject = json_decode($data, true);
        $constraints = (array) $dataObject;
        $query = Item::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != "") {
                $query = $query->with("category")->where( $fields[$index], '=',$constraint);
            }

            $index++;
        }
       return response()->json($query->paginate('5'));
    }
}
