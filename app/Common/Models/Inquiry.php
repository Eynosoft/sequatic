<?php

namespace App\Common\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    /**
     * Get the Inquiry record associated with the Country.
     */
    public function country()
    {
        return $this->belongsTo('App\Common\Models\MasterCountry','country_id');
    }
    
    public function detail()
    {
        return $this->hasMany('App\Common\Models\InquiryDetail','quote_id');
    }
    
    public function directory()
    {
        return $this->hasMany('App\Common\Models\uploadDirectory','inquiry_id');
    }
}