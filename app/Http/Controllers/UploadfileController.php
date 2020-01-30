<?php

namespace App\Http\Controllers;

use App\Notifications\SendSummaryToUser;
use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UploadfileController extends Controller
{
    function index(){
        return view('people.image');
    }

    function upload(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required|image|mimes:jpg,png,jpeg|max:2024'
     ]);
     $image = $request->file('select_file');
     $checkFace=$this->detectFace($image);
     if($checkFace != false){
          return $this->searchbyImageForLost($image);
     }
     else{
        return $this->errorPage(422,"No Face Found or more than One Face");
     }
    }
    public function searchbyImageForLost($image){
        $response= $this->searchByImage('lost',$image);
        if($response !=false) {
                auth()->user()->notify(new SendSummaryToUser($response));
                return response()->json(['nearest' => $response]);
            }
            else{
                return response()->json(['message' => "go to report page"]);

            }

        }
public  function getImageResult($response){
    return Report::where('image', '=', $response);

}

    function createReport($type){
        return view('people.form',['type'=>$type]);
    }

}
