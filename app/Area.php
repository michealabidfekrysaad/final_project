<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    protected $fillable = ['area_name','area_name_ar'];
    public function city(){
        $this->belongsTo(City::class);
    }
    public function items (){

        return $this->hasMany(Item::class);
    }
    public function reports (){
        return $this->hasMany(Report::class,'region');
    }
}
