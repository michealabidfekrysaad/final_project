<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class contactController extends Controller
{
    public function index()
    {
        $lastMessages = DB::table("contact")->latest("created_at")->take(3)->get();
        return view('layouts.AdminPanel.index', ['lastMessages' => $lastMessages]);
    }

    public function indexTable()
    {
        return view('layouts.AdminPanel.messages', ['contacts' => DB::table("contact")->latest("created_at")->paginate(5)]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'subject' => 'required|max:20',
            'message' => 'required',
        ]);
        DB::table('contact')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => now()
        ]);
        return redirect()->to('/contact')->with('message', 'Your message has been sent. Thank you!');
    }

    public function destroy($id)
    {
        DB::table("contact")->delete($id);
        return redirect()->to('/allmessages');
    }
}
