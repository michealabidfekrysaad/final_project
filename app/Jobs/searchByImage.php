<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class searchByImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $type;
    public $file;
    public $renderType=" ";


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($type,$file)
    {
        $this->type=$type;
        $this->file=$file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->type=="lost"){
            $this->renderType="found";
        }
        if($this->type=="found"){
            $this->renderType="lost";
        }
        foreach (DB::table('reports')->where('type','=',$this->renderType)->get(['image'])->toArray() as $value){
            $result = $this->getClient()->compareFaces([
                'SimilarityThreshold' => 0,
                'SourceImage' => [
                    'Bytes' => file_get_contents($this->file,true)
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

                return $similarity;
               // return $value->image;
            }
        }
       // return false;
    }
}
