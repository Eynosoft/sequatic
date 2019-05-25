<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\PanelFieldRepositoryInterface; 
use App\Common\Models\PanelField;

Class PanelFieldRepository implements PanelFieldRepositoryInterface
{
    protected $panelField;
        
    public function __construct(PanelField $panelField)
    {
            $this->panelField = $panelField;
    }
    
    /**
     * find field by id
     * @param type $id
     * @return mixed
     */
    public function find($id){
        return $this->panelField->find($id);
    }
    
    /**
     * find field list
     * @return mixed
     */
    public function findAll(){
        return $this->panelField->all();
    }
    
    /**
     * find by condition
     * @param type $att
     * @param type $value
     * @param type $column
     * @return mixed
     */
    public function findBy($att, $value, $column = array('*')){
        return $this->panelField->where($att, '=', $value)->get();
    }
    
}
