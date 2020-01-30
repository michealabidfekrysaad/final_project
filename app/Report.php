<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Notifications\Notifiable;
use App\Notifications\NotifyReport;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    
    use SoftDeletes;

    protected $table = 'reports';

    protected $fillable = ['name', 'age', 'gender', 'image', 'type', 'special_mark','eye_color','hair_color','city','region','location','last_seen_on','last_seen_at','lost_since','found_since','height','weight'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    public function scopeGetFilter($query){
      return $query->get();
    }
    public function searchableAs(){

        return "reports";
    
    }

    public function toSearchableArray()
    {
        $array =  $this->toArray();
        
        return $array;
    }
}
