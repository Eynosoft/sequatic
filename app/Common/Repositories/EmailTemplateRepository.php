<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\EmailTemplateRepositoryInterface;
use App\Common\Models\EmailTemplate;
use App\common\helpers\MessageOtherDetails;
use File;

Class EmailTemplateRepository implements EmailTemplateRepositoryInterface {

    protected $template;

    public function __construct(EmailTemplate $template) {
        $this->template = $template;
    }

    /**
     * find email by id
     * @param type $id
     * @return type mixed
     */
    public function findBySlug($slug) {
        return $this->template->where('title',$slug)->first();
    }
}
