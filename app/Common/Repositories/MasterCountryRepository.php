<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\MasterCountryRepositoryInterface; 
use App\Common\Models\MasterCountry;

Class MasterCountryRepository implements MasterCountryRepositoryInterface
{
    protected $country;
        
    public function __construct(MasterCountry $country)
    {
            $this->country = $country;
    }
    
    /**
     * find country by id
     */
    public function find(){
        
    }
    
    /**
     * get all country list
     * @return type mixed
     */
    public function findAll(){
        return $this->country->all();
    }
    
    /**
     * find by condition
     * @param type $att
     * @param type $column
     */
    public function findBy($att, $column){
        
    }
}
