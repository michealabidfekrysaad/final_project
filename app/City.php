<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = ['city_name', 'city_name_ar'];

    public function areas()
    {
        $this->hasMany(Area::class, 'city_id', 'id');
    }

    public function items()
    {

        return $this->hasMany(Item::class);
    }

    public function reports()
    {

        return $this->hasMany(Report::class, 'city');
    }
}
