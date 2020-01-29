<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadfileController extends Controller
{
    function index(){
        return view('people.image');
    }

    function upload(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required|image|mimes:jpg,png,jpeg|max:1'
     ]);

     $image = $request->file('select_file');

     $new_name = rand() . '.' . $image->getClientOriginalExtension();

     $image->move(public_path('images'), $new_name);
     return back()->with('success', 'Image Uploaded Successfully')->with('path', $new_name);
    }

    function createReport($type){
        return view('people.form',['type'=>$type]);
    }


    
}
