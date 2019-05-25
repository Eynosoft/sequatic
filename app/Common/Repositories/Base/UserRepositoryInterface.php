<?php

namespace App\Common\Repositories\Base;

interface UserRepositoryInterface
{
    
    public function find($id); 
    
    public function changePassword($request); 
    
    public function findByEmail($email); 
    
    public function findByToken($email); 
    
    public function loadSalesUserStatics($type); 
    
    
    
}
