<?php

namespace App;
use App\Item;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // protected $table = 'categories';

    protected $fillable = ['category_name'];

    public function item (){

        return $this->hasMany(Item::class);
    }
    public function attributes(){

        return $this->belongsToMany('App\Attribute' , 'attribute_category' , 'category_id' , 'attribute_id');
    }
}
