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
        $this->renderType = "";
    }

    public function getClient()
    {
        return $this->client = new RekognitionClient(
            [
                'version' => 'latest',
                'region' =>  env('AWS_DEFAULT_REGION'),
                'credentials' => [
                    'key' => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
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
    public function uploadImageToS3($path, $file)
    {

        $filenamewithextension = $file->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filenametostore = $path . $filename . '_' . time() . '.' . $extension;
        Storage::disk('s3')->put($filenametostore, fopen($file, 'r+'), 'public');
        return $filenametostore;

    }

    function startsWith($string, $startString)
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

}
