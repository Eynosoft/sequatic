<?php

namespace App\Common\Models;

use Illuminate\Database\Eloquent\Model;

class PanelField extends Model
{
    //
    /**
     * Get the Inquiry record associated with the Country.
     */
    public function master_field()
    {
        return $this->hasOne('App\Common\Models\MasterField','id');
    }
}
