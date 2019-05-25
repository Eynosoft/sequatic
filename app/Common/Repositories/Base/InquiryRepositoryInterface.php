<?php

namespace App\Common\Repositories\Base;

interface InquiryRepositoryInterface
{
    public function find($id);
    
    public function findAll();

    public function findBy($att, $value, $column);
    
    public function searchGeneralInquiry($post);
    
    public function searchTrashInquiry($post);
    
    public function createOrUpdate($post,$type);

    public function searchQuoteInquiry($post);
    
    
    
    public function toggleStatus($id,$post);
    
    public function loadGeneralInquiryStatics();
    
    public function deleteInquiry($id);
}
