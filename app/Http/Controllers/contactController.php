<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class contactController extends Controller
{
    public function store(Request $request){
        DB::table('contact')->insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
            'created_at'=>now()
        ]);
        return redirect()->to('/contact')->with('message','Your message has been sent. Thank you!');


    }
}
