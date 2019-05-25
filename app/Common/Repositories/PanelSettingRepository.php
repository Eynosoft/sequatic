<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\PanelSettingRepositoryInterface; 
use App\Common\Models\PanelSetting;

Class PanelSettingRepository implements PanelSettingRepositoryInterface
{
    protected $panelSetting;
        
    public function __construct(PanelSetting $panelSetting)
    {
            $this->panelSetting = $panelSetting;
    }
    
    /**
     * find panels setting by id
     * @param type $id
     * @return mixed
     */
    public function find($id){
        return $this->panelSetting->find($id);
    }
    
    /**
     * find panels setting list
     * @return mixed
     */
    public function findAll(){
        return $this->panelSetting->all();
    }
    
    /**
     * find panels setting by condition
     * @return mixed
     */
    public function findBy($conditionArray){
        return $this->panelSetting->where($conditionArray)->first();
    }
    
}
