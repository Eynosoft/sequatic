<?php

namespace App\Common\Repositories\Base;

interface MasterCountryRepositoryInterface
{
    public function find();
    
    public function findAll();

    public function findBy($att, $column);
}
