<?php

namespace App\Common\Models;

use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    //
    /**
     * Get the panelFields record associated with the Panel.
     */
    public function fields()
    {
        return $this->hasMany('App\Common\Models\PanelField','panel_id');
    }
    
    /**
     * Get the panelImages record associated with the Panel.
     */
    public function images()
    {
        return $this->hasMany('App\Common\Models\PanelImage','panel_id');
    }
}
