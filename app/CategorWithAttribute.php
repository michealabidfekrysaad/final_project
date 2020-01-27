<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategorWithAttribute extends Model
{
    protected $table = 'category_attribute';
    protected $fillable = ['category_id','attribute_id'];
}
