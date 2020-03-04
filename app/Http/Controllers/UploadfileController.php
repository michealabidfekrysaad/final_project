<?php

namespace App\Http\Controllers;

use App\Jobs\SearchByImage;
use Illuminate\Http\Request;

class UploadfileController extends Controller
{
    function index()
    {
        return view('people.image');
    }

    function upload(Request $request)
    {
        $this->validate($request, [
            'select_file' => 'required|image|mimes:jpg,png,jpeg|max:2024'
        ]);
        $image = $request->file('select_file');
        $checkFace = $this->detectFace($image);
        if ($checkFace != false) {
            return $this->searchbyImageForLost($image);
        } else {
            return $this->errorResponse(422, "No Face Found or more than One Face");
        }
    }

    public function searchbyImageForLost($image)
    {
        $tempUrl = $this->uploadImageToS3("temp/", $image);
        SearchByImage::dispatch("lookfor", $tempUrl, auth()->user())->onQueue('high');
        return view("popup");
    }


}
