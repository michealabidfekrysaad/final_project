<?php

namespace App\Jobs;

use App\Notifications\SendSummaryToUser;
use App\User;
use Aws\Rekognition\RekognitionClient;
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
use Nexmo\Client;
use Nexmo\Client\Credentials\Basic;


class SearchByImage implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $type;
    public $file;
    public $renderType = " ";
    public $user;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($type,$file,$user)
    {
        $this->type=$type;
        $this->file=$file;
        $this->user=$user;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $nearest=array();
        if($this->type=="lookfor"){
            $this->renderType="found";
        }
        if($this->type=="found"){
            $this->renderType="lost";
        }
        foreach (DB::table('reports')->where('type','=',$this->renderType)->get(['image'])->toArray() as $value){
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
        if(count($nearest)==0){
            $basic  = new \Nexmo\Client\Credentials\Basic('9576a3a8', 'xvyZTGB6xMhh32V9');
            $client = new \Nexmo\Client($basic);

            $message = $client->message()->send([
                'to' =>'20'.substr(($this->user)->phone,1),
                'from' => 'Nexmo',
                'text' => 'Sorry These person doesnt exist please make report'
            ]);
        }
        else{
            $this->user->notify(new SendSummaryToUser($nearest, ""));
            $basic  = new \Nexmo\Client\Credentials\Basic('9576a3a8', 'xvyZTGB6xMhh32V9');
            $client = new \Nexmo\Client($basic);

            $message = $client->message()->send([
                'to' =>'20'.substr(($this->user)->phone,1),
                'from' => 'Nexmo',
                'text' => 'Check Your Notification In ToFind Website'
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

    public function getClientForSms()
    {
        $basic  = new \Nexmo\Client\Credentials\Basic('9576a3a8', 'xvyZTGB6xMhh32V9');
        return new \Nexmo\Client($basic);
    }


    /**
     * @return mixed
     */

    /**
     * @inheritDoc
     */
}
