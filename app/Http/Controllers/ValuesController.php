<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\AttributeValue;
use Illuminate\Http\Request;

class ValuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->middleware('role:Admin')->only('indexAdmin');

    }

    public function index()
    {
        $value = AttributeValue::all();
        return view('items.find', ['value' => $value]);

    }

    public function indexAdmin()
    {
        $value = AttributeValue::all();
        return view('value.index', ['value' => $value]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $value = Attribute::with('valuesOfAttributes')->get();
        return view('value.create', ['value' => $value]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $value = new AttributeValue;
        $value->value_name = $request->input('value_name');
        $value->attribute_id = $request->get('attribute_id');
        $value->save();
        return redirect(route('value.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $value = AttributeValue::find($id);
        return view('value.show', ['value' => $value]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $value = AttributeValue::find($id);
        return view('value.edit', ['value' => $value]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $value = AttributeValue::find($id);
        $value->value_name = $request->input('value_name');
        $value->attribute_id = $request->get('attribute_id');
        $value->save();
        return redirect(route('value.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = Attribute::find($id)->delete();
        return redirect(route('value.index'));
    }
}
