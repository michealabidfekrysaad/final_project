<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attribute;
use DB;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attr = Attribute::all();
        return view('attribute.index' , ['attr' -> $attr]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = new Attribute;
        $attr->attribute_name = $request->input('attribute_name');
        $attr->save();
        return redirect(route('attribute.index'));
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
        $attr = Attribute::find($id)->delete();
        return redirect(route('attribute.index'));
    }
    
}
