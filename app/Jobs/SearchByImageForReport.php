<?php

namespace App\Jobs;

use App\Notifications\SendSummaryToUser;
use App\Report;
use App\User;
use Aws\Rekognition\RekognitionClient;
use Exception;
use http\Exception\RuntimeException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Nexmo\Client;
use Nexmo\Client\Credentials\Basic;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class SearchByImageForReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $type;
    public $file;
    public $renderType = " ";
    public $user;
    public $data;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user,$file,$type,$data)
    {
        $this->type=$type;
        $this->file=$file;
        $this->user=$user;
        $this->data=$data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $nearest = array();
        if ($this->type == "lookfor") {
            $this->renderType = "found";
        }
        if ($this->type == "found") {
            $this->renderType = "lost";
        }
        foreach (DB::table('reports')->where('type', '=', $this->renderType)->where("user_id",'!=',$this->user->id)->get(['image'])->toArray() as $value) {
            $result = $this->getClient()->compareFaces([
                'SimilarityThreshold' => 0,
                'SourceImage' => [
                    'S3Object' => [
                        'Bucket' => 'loseall',
                        'Name' => $this->file,
                    ],
                ],
                'TargetImage' => [
                    'S3Object' => [
                        'Bucket' => 'loseall',
                        'Name' => $value->image,
                    ],
                ],

            ]);
            $similarity = (int)$result->get('FaceMatches')[0]['Similarity'];
            if ($similarity > 80) {
                array_push($nearest, $value->image);
            }
        }
        $fileAsByte = $this->convertUrlToImageFile($this->file);
        $newArray = array(
            'image' => $this->uploadImageToS3("people/", $fileAsByte),
            'user_id' => $this->user->id,
            'created_at'=>now()
        );
        $finalArray = array_merge($this->data, $newArray);
        if(count($nearest)==0){
            DB::table("reports")->insert($finalArray);
            $basic  = new \Nexmo\Client\Credentials\Basic('6de49b6e', 'atjBwti3oZtsUOCd');
            $client = new \Nexmo\Client($basic);
            $message = $client->message()->send([
                'to' =>'20'.substr(($this->user)->phone,1),
                'from' => 'ToFind',
                'text' => 'Sorry This person doesnt exist your report is created successfully'
            ]);
           // $this->user->notify(new SendSummaryToUser($nearest, $finalArray));
        }
        else{
            $this->user->notify(new SendSummaryToUser($nearest, $finalArray));
            $basic  = new \Nexmo\Client\Credentials\Basic('6de49b6e', 'atjBwti3oZtsUOCd');
            $client = new \Nexmo\Client($basic);
            $message = $client->message()->send([
                'to' =>'20'.substr(($this->user)->phone,1),
                'from' => 'ToFind',
                'text' => 'please visit ToFind website to check your notification.it is important'
            ]);
        }
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



    public function uploadImageToS3($path, $file)
    {

        $filenamewithextension = $file->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filenametostore = $path . $filename . '_' . time() . '.' . $extension;
        Storage::disk('s3')->put($filenametostore, fopen($file, 'r+'), 'public');
        return $filenametostore;

    }

    public function convertUrlToImageFile($tempUrl)
    {
        $url = 'https://loseall.s3.us-east-2.amazonaws.com/' .$tempUrl;
        $info = pathinfo($url);
        $contents = file_get_contents($url);
        $file = '/tmp/' . $info['basename'];
        file_put_contents($file, $contents);
        return new UploadedFile($file, $info['basename']);
    }
}
