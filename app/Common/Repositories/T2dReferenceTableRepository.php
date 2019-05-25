<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\T2dReferenceTableRepositoryInterface; 
use App\Common\Models\T2dReferenceTable;

Class T2dReferenceTableRepository implements T2dReferenceTableRepositoryInterface
{
    protected $t2dReferenceTable;
        
    public function __construct(T2dReferenceTable $t2dReferenceTable)
    {
            $this->t2dReferenceTable = $t2dReferenceTable;
    }
    
    /**
     * 
     */
    
    public function find($id){
        return $this->inquiry->find($id);
    }
    
    /**
     * 
     * @return mixed 
     */
    public function findAll(){
        return $this->t2dReferenceTable->all();
    }

    public function findBy($conditionArray){
        return $this->t2dReferenceTable->where($conditionArray);
    }
    
    public function get2dReferenceValueOfT($t2d = null){
        return $this->t2dReferenceTable->select('ref_value_b','ref_value_c')->where([['min_val','<=',$t2d],['max_val','>=',$t2d]])->first();
    }
    
}
