<?php

namespace App\Common\Models;

use Illuminate\Database\Eloquent\Model;

class uploadDirectory extends Model
{
    //
    /**
     * Get the Inquiry record associated with the Country.
     */
    public function files()
    {
        return $this->hasMany('App\Common\Models\DirectoryFiles','directory_id');
    }
}
