<?php

namespace App\Common\Repositories\Base;

interface MasterFieldRepositoryInterface
{
    public function find($id);
    
    public function findAll();

    public function findBy($att, $column);
}
