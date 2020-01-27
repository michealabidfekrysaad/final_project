<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attributes';
    protected $fillable = ['name'];

    public function valuesOfAttributes(){

        return $this->hasMany('App\AttributeValue' , 'attribute_id' , 'id');

    }

    public function ItemAttributeValues(){

        return $this->hasMany('App\AttributeValue' , 'attribute_id' , 'id');

    }

    public function categoryAttribute(){

        return $this->hasMany('App\CategoryItems' , 'attribute_id' , 'id');
        
    }
}
