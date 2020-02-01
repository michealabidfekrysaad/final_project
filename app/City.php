<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    public function areas(){
        $this->hasMany(Area::class,'city_id');
    }
    public function items (){

        return $this->hasMany(Item::class);
    }
    public function reports (){

        return $this->hasMany(Report::class,'city');
    }
}
