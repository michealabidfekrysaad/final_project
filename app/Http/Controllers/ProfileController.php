<?php

namespace App\Http\Controllers;

use App\Notifications\SendSummaryToUser;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\User;
use App\Report;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $profile = auth()->user();
        $notifications=auth()->user()->unreadNotifications()->latest()->limit(5)->get()->toArray();
        return view('user.index' , [
            'profile'=>$profile,
            'notifications'=>$notifications,
            'reports'=>$profile->reports,
            'items'=>$profile->items
        ]
        );

        return view('user.index' , compact('profile' , 'report'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $profile = auth()->user();
        return view('user.edit' ,compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'email|unique:users,email,' . auth()->user()->id,
        ]);
        $profile = auth()->user()->find($id);
        $profile->name = $request->input('name');
        $profile->email = $request->input('email');
        $profile->phone = $request->input('phone');
        $profile->save();
        return redirect(route('profile.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    public function viewResultFromNotification($results){
       $response= DB::table("notifications")->where("id","=",$results)->get();
       $arrayOfResults=json_decode($response[0]->data);
        $arrayOfResultsAfterEncode= ($arrayOfResults->data)->result;
        $insertedData=($arrayOfResults->data)->insertedData;
        session()->put('report',$insertedData);
        $notification = auth()->user()->notifications()->where('id','=',$results)->first();
        if($notification) {
            $notification->markAsRead();
        }
       return view("showResultNotification",[
           "results"=>$this->getQueryReportsForResults($arrayOfResultsAfterEncode)
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
        return redirect()->route('profile.index');
        }
    }
