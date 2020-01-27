<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Item;
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
        // return view('items/index', [
        //     'items' => $items,
        // ]);
    }
    public function myItems()
    {
        $items = auth()->user()->items ;//Report::paginate(10);
        return view('items/index', [
            'items' => $items,
        ]);
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
        if(auth()->user()->id==$item->user()->id){
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
}
