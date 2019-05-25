<?php

namespace App\Common\Repositories\Base;

interface SupportPanel4sideRepositoryInterface
{
    
    public function find($id);
    
    public function findBy($conditionArray);
    
    public function findAll();
   
}
