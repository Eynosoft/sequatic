<?php

namespace App\Common\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * Get the Inquiry record associated with the Country.
     */
    public function role()
    {
        return $this->belongsTo('App\Common\Models\Role','role_id','id');
    }
    
    public function country()
    {
        return $this->belongsTo('App\Common\Models\MasterCountry','country_id','id');
    }
}
