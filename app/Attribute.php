<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attributes';
    protected $fillable = ['name'];

    public function category(){

        return $this->belongsToMany(Category::class);
    }
}
