<?php

namespace App\Common\Repositories\Base;

interface uploadDirectoryRepositoryInterface
{
    public function find($id);
    
    public function findAll();

    public function findBy($att, $value, $column);
    
    public function create($post);
    
    public function toggleStatus($id,$post);
    
    public function deleteDirectory($id);
    
    public function findAllByInquiryId($id);
   
}
