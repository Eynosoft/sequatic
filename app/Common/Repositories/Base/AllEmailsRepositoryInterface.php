<?php

namespace App\Common\Repositories\Base;

interface AllEmailsRepositoryInterface
{
    
    
    public function find($id);
    
    public function searchEmails($request);
    
    public function paginate($perPage = 15, $columns = array('*'));
    
    public function syncEmails($emails);
    
    public function getLastSyncTime();
    
    public function addToSendList($data);
    
    public function getInquiryEmails($id);
}
