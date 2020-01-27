<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DescriptionValidation extends Model
{
    protected $table = 'description_validation';
    protected $fillable = ['founder_id' , 'lost_id' , 'description' , 'status'];

    public function founder(){
        return $this->belongsTo('App\User');
    }
    public function lost(){
        return $this->belongsTo('App\User');
    }
}
