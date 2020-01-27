<?php

namespace App;
use App\Item;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = ['category_name'];

    public function item (){

        return $this->hasMany(Item::class);
    }
    public function attributes(){

        return $this->belongsToMany(Attribute::class);
    }
}
