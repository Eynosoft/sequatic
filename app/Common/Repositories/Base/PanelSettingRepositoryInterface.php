<?php

namespace App\Common\Repositories\Base;

interface PanelSettingRepositoryInterface
{
    
    public function find($id);
    
    public function findBy($conditionArray);
    
    public function findAll();
   
}
