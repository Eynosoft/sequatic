<?php

namespace App\Common\Repositories\Base;

interface InquiryDetailRepositoryInterface
{
    public function find($id);
    
    public function findAll();

    public function findBy($att, $value, $column);
    
    public function createOrUpdate($post);
    
    public function loadQuoteDetail($id,$post);
    
    public function createClone($post);
    
    public function findByVersion($id,$vId);
    
    public function updateQuoteStatus($id);
    
}
