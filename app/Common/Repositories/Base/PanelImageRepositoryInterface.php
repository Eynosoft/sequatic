<?php

namespace App\Common\Repositories\Base;

interface PanelImageRepositoryInterface
{
    public function find($id);
    
    public function findAll();

    public function findBy($att, $column);
}
