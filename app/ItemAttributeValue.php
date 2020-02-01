<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemAttributeValue extends Model
{
    protected $table = '_item_attribute_values';
    protected $fillable = ['attribute_id' , 'value_id' , 'item_id'];

    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }
    public function value(){
        return $this->belongsTo(AttributeValue::class);
    }
    public function Item(){
        return $this->belongsTo(Item::class);
    }
}
