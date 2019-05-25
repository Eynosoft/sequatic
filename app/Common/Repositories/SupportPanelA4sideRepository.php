<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\SupportPanelA4sideRepositoryInterface; 
use App\Common\Models\SupportPanelA4side;

Class SupportPanelA4sideRepository implements SupportPanelA4sideRepositoryInterface
{
    protected $supportPanelA4side;
        
    public function __construct(SupportPanelA4side $supportPanelA4side)
    {
            $this->supportPanelA4side = $supportPanelA4side;
    }
    
    /**
     * 
     */
    
    public function find($id){
        return $this->supportPanelA4side->find($id);
    }
    
    /**
     * 
     * @return mixed 
     */
    public function findAll(){
        return $this->supportPanelA4side->all();
    }

    public function findBy($conditionArray){
        return $this->supportPanelA4side->where($conditionArray);
    }
    
    public function get2dReferenceValueOfT($t2d = null){
        return $this->supportPanelA4side->select('ref_value_b','ref_value_c')->where([['min_val','<=',$t2d],['max_val','>=',$t2d]])->first();
    }
    
}
