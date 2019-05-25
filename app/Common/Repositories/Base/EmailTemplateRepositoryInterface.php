<?php

namespace App\Common\Repositories\Base;

interface EmailTemplateRepositoryInterface
{
    
    
    public function findBySlug($slug);
}
