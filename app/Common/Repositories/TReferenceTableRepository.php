<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\TReferenceTableRepositoryInterface; 
use App\Common\Models\TReferenceTable;

Class TReferenceTableRepository implements TReferenceTableRepositoryInterface
{
    protected $tReferenceTable;
        
    public function __construct(TReferenceTable $tReferenceTable)
    {
            $this->tReferenceTable = $tReferenceTable;
    }
    
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function find($id){
        return $this->inquiry->find($id);
    }
    
    /**
     * find all reference data
     * @return mixed 
     */
    public function findAll(){
        return $this->tReferenceTable->all();
    }
    
    /**
     * 
     * @param type $conditionArray
     * @return type
     */
    public function findBy($conditionArray){
        return $this->tReferenceTable->where($conditionArray);
    }
    
    /**
     * 
     * @param type $T
     * @return type
     */
    public function getReferenceValueOfT($T){
        $row = $this->tReferenceTable->max('min_val');
        if($T < $row){
            $rec = $this->tReferenceTable->select('max_val')->where([['min_val','<',$T],['max_val','>=',$T]])->first();
            if(!empty($rec)){
                return $rec->max_val;
            }
        }else{
            return $T;
        }
    }
    
    
    
    
    
}
