<?php

namespace App\Common\Repositories\Base;

interface T2dReferenceTableRepositoryInterface
{
    
    public function find($id);
    
    public function findBy($conditionArray);
    
    public function findAll();
   
}
