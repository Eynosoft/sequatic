<?php

namespace App\Common\Repositories\Base;

interface TReferenceTableRepositoryInterface
{
    
    public function find($id);
    
    public function findBy($conditionArray);
    
    public function findAll();
   
}
