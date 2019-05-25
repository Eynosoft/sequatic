<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\SupportPanel4sideRepositoryInterface; 
use App\Common\Models\SupportPanel4side;

Class SupportPanel4sideRepository implements SupportPanel4sideRepositoryInterface
{
    protected $supportPanel4side;
        
    public function __construct(SupportPanel4side $supportPanel4side)
    {
            $this->supportPanel4side = $supportPanel4side;
    }
    
    /**
     * 
     */
    
    public function find($id){
        return $this->supportPanel4side->find($id);
    }
    
    /**
     * 
     * @return mixed 
     */
    public function findAll(){
        return $this->supportPanel4side->all();
    }

    public function findBy($conditionArray){
        return $this->supportPanel4side->where($conditionArray);
    }
    
    public function get2dReferenceValueOfT($t2d = null){
        
        return $this->supportPanel4side->select('ref_value_bu','ref_value_cu')->where([['min_val','<=',$t2d],['max_val','>=',$t2d]])->first();
    }
    
}
