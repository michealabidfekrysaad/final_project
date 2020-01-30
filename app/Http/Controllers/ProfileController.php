<?php

namespace App\Http\Controllers;

use App\Notifications\SendSummaryToUser;
use Illuminate\Http\Request;
use App\User;
use App\Report;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $profile = auth()->user();
        $notifications=auth()->user()->unreadNotifications()->latest()->limit(5)->get()->toArray();
        $report = Report::with('user')->where('user_id' , '=' , auth()->user()->id)->get();
        return view('user.index' , [
            'profile' => $profile,
            'notifications'=>$notifications,
            'report'=>$report
        ]
        );

        
    
        return view('user.index' , compact('profile' , 'report'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$profile = auth()->user()->find($id);
        $profile = auth()->user();

       // $profile = auth()->user()->$id;
        
        return view('user.edit' ,compact('profile'));
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
        $profile = auth()->user()->find($id);
        $profile->name = $request->input('name');
        $profile->email = $request->input('email');
        $profile->phone = $request->input('phone');
        $profile->city = $request->input('city');
        $profile->region = $request->input('region');
        $profile->save();
        return redirect(route('profile.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function viewResultFromNotification($results){
       $response= DB::table("notifications")->where("id","=",$results)->get();
       $arrayOfResults=json_decode($response[0]->data)->data;
       $this->getQueryReportsForResults($arrayOfResults);
       return view("showResultNotification",[
           "results"=>$this->getQueryReportsForResults($arrayOfResults)
    ]);
    }
    public function getQueryReportsForResults($arrayOfResults)
    {
        $returnArray=array();
        foreach ($arrayOfResults as $result){
            array_push($returnArray,Report::where("image","=",$result)->get());
        }
        return $returnArray;
    }
    public function  readNotification($id){
            $notification = auth()->user()->notifications()->where('id','=',$id)->first();
            if($notification) {
                $notification->markAsRead();
            }
            return redirect("/profile");

        }
    }
