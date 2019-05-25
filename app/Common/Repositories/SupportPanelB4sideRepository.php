<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\SupportPanelB4sideRepositoryInterface; 
use App\Common\Models\SupportPanelB4side;

Class SupportPanelB4sideRepository implements SupportPanelB4sideRepositoryInterface
{
    protected $supportPanelB4side;
        
    public function __construct(SupportPanelB4side $supportPanelB4side)
    {
            $this->supportPanelB4side = $supportPanelB4side;
    }
    
    /**
     * 
     */
    
    public function find($id){
        return $this->supportPanelB4side->find($id);
    }
    
    /**
     * 
     * @return mixed 
     */
    public function findAll(){
        return $this->supportPanelB4side->all();
    }

    public function findBy($conditionArray){
        return $this->supportPanelB4side->where($conditionArray);
    }
    
    public function get2dReferenceValueOfT($t2d = null){
        return $this->supportPanelB4side->select('ref_value_b','ref_value_c')->where([['min_val','<=',$t2d],['max_val','>=',$t2d]])->first();
    }
    
}
