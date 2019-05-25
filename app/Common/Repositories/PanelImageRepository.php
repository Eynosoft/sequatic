<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\PanelImageRepositoryInterface; 
use App\Common\Models\PanelImage;

Class PanelImageRepository implements PanelImageRepositoryInterface
{
    protected $panelImage;
        
    public function __construct(PanelImage $panelImage)
    {
            $this->panelImage = $panelImage;
    }
    
   /**
     * find email by id
     * @param type $id
     * @return type mixed
     */
    public function find($id){
        return $this->panelImage->find($id);
    }
    
    /**
     * get all panel images
     * @return mixed 
     */
    public function findAll(){
        return $this->panelImage->all();
    }
    
    /**
     * get images by condition
     * @param type $att
     * @param type $value
     * @param type $column
     * @return mixed
     */
    public function findBy($att, $value, $column = array('*')){
        return $this->panelImage->where($att, '=', $value)->get();
    }
    
}
