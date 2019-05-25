<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\PanelsRepositoryInterface; 
use App\Common\Models\Panel;

Class PanelsRepository implements PanelsRepositoryInterface
{
    protected $panel;
        
    public function __construct(Panel $panel)
    {
            $this->panel = $panel;
    }
    
    /**
     * find panel by id 
     * @param type $id
     * @return mixed 
     */
    public function find($id){
        return $this->panel->find($id);
    }
    
    /**
     * get list of all panels
     * @return mixed 
     */
    public function findAll(){
        return $this->panel->all();
    }
    
    /**
     * find panel by condition
     * @param type $att
     * @param type $value
     * @param type $column
     * @return mixed 
     */
    public function findBy($att, $value, $column = array('*')){
        return $this->panel->where($att, '=', $value);
    }
}
