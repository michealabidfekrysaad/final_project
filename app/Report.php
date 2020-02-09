<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\NotifyReport;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{

    use SoftDeletes;

    protected $table = 'reports';

    protected $fillable = ['name', 'age', 'gender', 'image', 'type', 'special_mark','eye_color','hair_color','city_id','area_id','location','last_seen_on','last_seen_at','lost_since','found_since','height','weight','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
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
