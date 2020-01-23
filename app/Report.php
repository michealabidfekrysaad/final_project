<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Laravel\Scout\Searchable;



class Report extends Model
{
    use Searchable;
    protected $fillable = ['name', 'age', 'gender', 'image', 'type', 'special_mark','eye_color','hair_color','city','region','location','last_seen_on','last_seen_at','lost_since','found_since','height','weight',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function searchableAs()
    {
        return 'reports';
    }
}