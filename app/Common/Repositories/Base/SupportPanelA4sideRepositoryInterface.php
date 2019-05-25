<?php

namespace App\Common\Repositories\Base;

interface SupportPanelA4sideRepositoryInterface
{
    
    public function find($id);
    
    public function findBy($conditionArray);
    
    public function findAll();
   
}
