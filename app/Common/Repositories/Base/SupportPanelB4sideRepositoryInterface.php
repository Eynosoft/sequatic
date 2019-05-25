<?php

namespace App\Common\Repositories\Base;

interface SupportPanelB4sideRepositoryInterface
{
    
    public function find($id);
    
    public function findBy($conditionArray);
    
    public function findAll();
   
}
