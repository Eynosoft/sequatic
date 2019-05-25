<?php

namespace App\Common\Repositories\Base;

interface PanelFieldRepositoryInterface
{
    public function find($id);
    
    public function findAll();

    public function findBy($att, $column);
}
