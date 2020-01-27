<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table = 'values_of_attributes';
    protected $fillable = ['value_name' , 'attribute_id'];

    public function attribute(){

        return $this->belongsTo('App\Attribute');

    }

    public function valueItemAttribute(){

        return $this->hasMany('App\ItemAttributeValue' , 'value_id' , 'id');

    }
    
}
