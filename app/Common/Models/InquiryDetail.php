<?php

namespace App\Common\Models;

use Illuminate\Database\Eloquent\Model;

class InquiryDetail extends Model
{
    /**
     * Get the Inquiry record associated with the Country.
     */
    public function inquiry()
    {
        return $this->belongsTo('App\Common\Models\Inquiry','quote_id','id');
    }
    
    /**
     * Get the Inquiry record associated with the Country.
     */
    public function panel()
    {
        return $this->belongsTo('App\Common\Models\Panel','panel_id','id');
    }
}
