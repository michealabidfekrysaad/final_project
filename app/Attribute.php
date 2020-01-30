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
    public function valuesOfAttributes(){

        return $this->hasMany('App\AttributeValue' , 'attribute_id' , 'id');

    }

    public function ItemAttributeValues(){

        return $this->hasMany('App\AttributeValue' , 'attribute_id' , 'id');

    }

    public function categoryAttribute(){

        return $this->belongsToMany('App\Category' , 'attribute_category' , 'attribute_id' , 'category_id');

    }




    public function ItemAttributeValue(){//islam
        return $this->hasMany(ItemAttributeValue::class,"attribute_id");
    }
}
