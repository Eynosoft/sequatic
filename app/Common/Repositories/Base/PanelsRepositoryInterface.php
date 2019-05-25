<?php

namespace App\Common\Repositories\Base;

interface PanelsRepositoryInterface
{
    public function find($id);
    
    public function findAll();

    public function findBy($att, $value, $column);
}
