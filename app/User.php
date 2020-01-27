<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;



class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone' , 'city' , 'region' , 'google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function userFounder()
    {
        return $this->hasMany('App\DescriptionValidation', 'founder_id', 'id');
    }
    public function userLost()
    {
        return $this->hasMany('App\DescriptionValidation', 'lost_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
