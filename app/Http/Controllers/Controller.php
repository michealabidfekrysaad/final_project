<?php

namespace App\Http\Controllers;

use Aws\Rekognition\RekognitionClient;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    private $client;
    private $renderType;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->renderType="";
    }

    public function getClient()
    {
        return $this->client = new RekognitionClient(
            [
                'version' => 'latest',
                'region' => 'us-east-2',
                'credentials' => [
                    'key' => 'AKIA5WVDM6FIA5253O7V',
                    'secret' => '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'
                ]]);
    }

    public function detectFace($file)
    {
            $filenamewithextension = $file;
            $result = $this->getClient()->detectFaces([
                'Image' => [
                    'Bytes' => file_get_contents($filenamewithextension, true)
                ],
            ]);
            if (count($result->get('FaceDetails')) == 1) {
                return true;
            } else {
                return false;
            }
    }
    public function searchByImage($type,$file){
        $nearest=array();
        if($type=="lost"){
            $this->renderType="found";
        }
        if($type=="found"){
            $this->renderType="lost";
        }
        foreach (DB::table('reports')->where('type','=',$this->renderType)->get(['image'])->toArray() as $value){
            $result = $this->getClient()->compareFaces([
                'SimilarityThreshold' => 0,
                'SourceImage' => [
                    'Bytes' => file_get_contents($file,true)
                ],
                'TargetImage' => [
                    'S3Object' => [
                        'Bucket' => 'loseall',
                        'Name' => $value->image,
                    ],
                ],

            ]);
            $similarity=(int)$result->get('FaceMatches')[0]['Similarity'];
            if ($similarity > 80)
            {
                array_push($nearest,$value->image);
            }
        }
        if(count($nearest)==0) return false;
        return $nearest;
    }

    public function uploadImageToS3($path,$file){

        $filenamewithextension = $file->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filenametostore = $path.$filename.'_'.time().'.'.$extension;
        Storage::disk('s3')->put($filenametostore, fopen($file, 'r+'), 'public');
        // $image_url='https://loseall.s3.us-east-2.amazonaws.com/'.$filenametostore;
        return $filenametostore;

    }
    public function errorPage($code,$message){
        return response()->json(['code'=>$code,'message'=>$message]);
    }
    function startsWith ($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }
}
