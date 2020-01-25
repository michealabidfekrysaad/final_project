<?php
//require 'vendor/autoload.php';
//use Aws\Rekognition\RekognitionClient;

namespace App\Http\Controllers;

use Aws\Rekognition\RekognitionClient;
use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TestsController extends Controller
{
    private $client;
    public function __construct()
   {
       $this->client = new RekognitionClient(
           [
               'version'=>'latest',
               'region'=>'us-east-2',
               'credentials'=>[
                   'key'=>'AKIA5WVDM6FIA5253O7V',
                   'secret'=>'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'
               ]]);
   }
    public function test(Request $request){
        if($request->hasFile('image'))
        {
            $filenamewithextension = $request->file('image');
            $result = $this->client->detectFaces([
                'Image' => [
                    'Bytes' => file_get_contents($filenamewithextension,true)
                ],
            ]);
            if (count($result->get('FaceDetails'))==1){

                return response()->json('detect one person successfully');

            }
            else if (count($result->get('FaceDetails'))>1){
                  return response()->json('there are more than one person');
            }
            else{
                return response()->json('there are no person in image');
            }
        }


//        $result = $this->client->compareFaces([
//            'SimilarityThreshold' => 0,
//            'SourceImage' => [
//                'S3Object' => [
//                    'Bucket' => 'loseall',
//                    'Name' => 'people/images_1579866863.jpeg',
//                ],
//            ],
//            'TargetImage' => [
//                'S3Object' => [
//                    'Bucket' => 'loseall',
//                    'Name' => 'people/rm_1579861570.jpg',
//                ],
//            ],
//
//        ]);
//        return response()->json([
//            'Similarity'=> $result->get('FaceMatches')[0]['Similarity']
//        ]);

  }
    public function index()
    {
        $url = 'https://loseall.s3.us-east-2.amazonaws.com/';
        $images = [];
        $files = Storage::disk('s3')->files('people');
        foreach ($files as $file) {
            $images[] = [
                'name' => str_replace('people/', '', $file),
                'src' => $url . $file
            ];
        }
        return response()->json($images);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|max:2048'
        ]);
        if($request->hasFile('image')) {

            $filenamewithextension = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenametostore = 'people/'.$filename.'_'.time().'.'.$extension;
            Storage::disk('s3')->put($filenametostore, fopen($request->file('image'), 'r+'), 'public');
            $image_url='https://loseall.s3.us-east-2.amazonaws.com/'.$filenametostore;
            return response()->json(['image_url'=>$image_url]);
        }
    }
    public function destroy($image)
    {
        if(Storage::disk('s3')->exists('people/' . $image)){
            Storage::disk('s3')->delete('people/' . $image);
            return response()->json('Image was deleted successfully');
        }
        else  return response()->json('Image Not Found');
    }
}
