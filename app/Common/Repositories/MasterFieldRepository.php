<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\MasterFieldRepositoryInterface; 
use App\Common\Models\MasterField;

Class MasterFieldRepository implements MasterFieldRepositoryInterface
{
    protected $masterField;
        
    public function __construct(MasterField $masterField)
    {
            $this->masterField = $masterField;
    }
    
    /**
     * find email by id
     * @param type $id
     * @return type mixed
     */
    public function find($id){
        return $this->masterField->find($id);
    }
    
    /**
     * get all masterfields
     * @return mixed 
     */
    public function findAll(){
        return $this->masterField->all();
    }
    
    /**
     * find masterfields by condition
     * @param type $att
     * @param type $value
     * @param type $column
     * @return mixed
     */
    public function findBy($att, $value, $column = array('*')){
        return $this->masterField->where($att, '=', $value)->get();
    }
    
}
