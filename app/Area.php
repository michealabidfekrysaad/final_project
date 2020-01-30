<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    public function city(){
        $this->belongsTo(City::class);
    }
    public function items (){

        return $this->hasMany(Item::class);
    }
}
