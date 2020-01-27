<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemAttributeValue extends Model
{
    protected $table = '_item_attribute_values';
    protected $fillable = ['attribute_id' , 'value_id' , 'item_id'];

    public function attributeItem(){
        return $this->belongsTo('App\Attribute');
    }
    public function valueAttribute(){
        return $this->belongsTo('App\AttributeValue');
    }
    public function ItemsAttribute(){
        return $this->belongsTo('App\Item');
    }
}
