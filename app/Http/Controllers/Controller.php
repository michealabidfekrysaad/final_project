<?php

namespace App\Http\Controllers;

use Aws\Rekognition\RekognitionClient;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
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
        if($type=="lookfor"){
            $this->renderType="found";
        }
        if($type=="found"){
            $this->renderType="lost";
        }
        foreach (DB::table('reports')->where('type','=',$this->renderType)->get(['image'])->toArray() as $value){
            $result = $this->getClient()->compareFaces([
                'SimilarityThreshold' => 0,
                'SourceImage' => [
//                    'Bytes' => file_get_contents($file,true)
                    'S3Object' => [
                        'Bucket' => 'loseall',
                        'Name' => $file,
                    ],
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
    function startsWith ($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }

    public function deleteImageFromS3($image)
    {
        if (Storage::disk('s3')->exists($image)) {
            Storage::disk('s3')->delete($image);
        }
    }

    public function errorResponse($message, $code)
    {
        return view("error", [
            'message' => $message,
            'code' => $code
        ]);
    }

    public function increaseView()
    {
        $value = 0;
        $row = DB::table('visitor')->where(DB::raw("year(created_at)"), '=', now()->year)->first();
        $value = $row->viewer + 1;
        DB::table('visitor')->where(DB::raw("year(created_at)"), '=', now()->year)
            ->update(['viewer' => $value]);
        return response()->json($row);
    }

    public function increaseClick()
    {
        $value = 0;
        $row = DB::table('visitor')->where(DB::raw("year(created_at)"), '=', now()->year)->first();
        $value = $row->click + 1;
        DB::table('visitor')->where(DB::raw("year(created_at)"), '=', now()->year)
            ->update(['click' => $value]);
        return response()->json($row);
    }
    protected function paginate(Collection $collection)
    {

        $page = LengthAwarePaginator::resolveCurrentPage();//11
        $perPage =6;
        if (request()->has('per_page')) {
            $perPage = (int) request()->per_page;
        }
        $results = $collection->slice(($page - 1) * $perPage, $perPage)->values();//split every page to 15 1..15  16..30
        $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),//links to previous and next pages
        ]);
        $paginated->appends(request()->all());//Add a set of query string values to the paginator.
        return $paginated;

    }
}
