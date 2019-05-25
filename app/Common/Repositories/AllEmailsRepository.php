<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\AllEmailsRepositoryInterface;
use App\Common\Models\AllEmail;
use App\common\helpers\MessageOtherDetails;
use File;

Class AllEmailsRepository implements AllEmailsRepositoryInterface {

    protected $allEmail;
    protected $messageDetails;

    public function __construct(AllEmail $allEmail) {
        $this->allEmail = $allEmail;
    }

    /**
     * find email by id
     * @param type $id
     * @return type mixed
     */
    public function find($id) {
        return $this->allEmail->find($id);
    }

    /**
     * search and get emails list
     * @param type $request
     * @return file title rename
     */
    public function searchEmails($request,$type = 'recieved') {

        $data = \Illuminate\Support\Facades\DB::table('all_emails');
        $data->selectRaw('*');
        $data->whereRaw("inquiry_id is Null AND email_type = '".$type."'");
        if (!empty($request->keyword)) {
            $data->whereRaw("MATCH (email_subject,email_text_body,email_html_body,attachments) AGAINST ('" . $request->keyword . "' IN BOOLEAN MODE) ");
        }
        $data->orderByRaw('date_time DESC');
        $data = $data->paginate(10);
        return $data;
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*')) {
        return $this->allEmail->paginate($perPage, $columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function syncEmails($messages) {
        if (count($messages) > 0) {
            foreach ($messages as $message) {
                $model = new AllEmail();
                $mailExists = $this->isMailExists($message->getNumber());
                if (!$mailExists) {
                    $sender_name = $this->getSenderName($message);
                    $attachments = $this->saveAttachments($message);
                    $model->email_unique_id = $message->getId();
                    $model->email_no = $message->getNumber();
                    $model->email_subject = $message->getSubject();
                    $model->email_text_body = $message->getBodyText();
                    $model->email_html_body = $message->getBodyHtml();
                    $model->from_email = $message->getFrom();
                    $model->from_name = $sender_name;
                    $model->date_time = $message->getDate();
                    $model->email_type = 'recieved';
                    $model->has_attachment = count($attachments) > 0 ? 1 : 0;
                    $model->attachments = json_encode($attachments);
                    if (preg_match('/[A-Z]{2}\.[0-9]{2}/', $model->email_subject, $match)) {
                        if (count($match) > 0) {
                            $inq_number = explode('.', $match[0]);
                            if (count($inq_number) > 0) {
                                $model->inquiry_id = $inq_number[1];
                            }
                        }
                    }
                    if ($model->save()) {
                        
                    } else {
                        dd('something went wrong.' . $message->getDate());
                        die;
                    }
                }
            }
        }
    }

    /**
     * save email attachments
     * @param type $message
     * @return type array
     */
    public function saveAttachments($message) {
        $attachment_list = array();
        if ($message->hasAttachments()) {
            $attachments = $message->getAttachments();
            foreach ($attachments as $attachment) {
                if ($attachment) {
                    // getDecodedContent() decodes the attachment’s contents automatically:
                    $filepath = public_path() . '/attachments/' . $attachment->getFilename();

                    file_put_contents($filepath, $attachment->getDecodedContent());

                    if (MessageOtherDetails::disposition($attachment) !== 'INLINE') {
                        $attachment_list[] = $attachment->getFilename();
                    }
                }
            }
        }
        return $attachment_list;
    }

    /**
     * get email sender name
     * @param type $message
     * @return type mixed
     */
    public function getSenderName($message) {
        return MessageOtherDetails::getToName($message);
    }

    /**
     * get last sync time
     * @return date || boolean
     */
    public function getLastSyncTime() {
        $rec = $this->allEmail->select('date_time')->orderBy('date_time', 'desc')->first();
        if (!empty($rec)) {
            return $rec->date_time;
        } else {
            return false;
        }
    }

    /**
     * check if email already exists
     * @param type $email_no
     * @return type mixed
     */
    public function isMailExists($email_no) {
        return $this->allEmail->where('email_no', $email_no)->first();
    }

    /**
     * mark an email as read
     * @param type $id
     * @return boolean
     */
    public function markAsRead($id) {
        $email = $this->find($id);
        if ($email) {
            $email->is_read = 1;
            return $email->save();
        }
        return false;
    }

    public function unreadCount($qid = null) {
        $query = $this->allEmail->where('is_read', 0);
        if ($qid) {
            $query->where('inquiry_id', $qid);
        }
        return $query->count();
    }

    public function addToSendList($data) {
        $model = $this->allEmail;
        $attachments = array();
        if(!empty($data['attachments'])){
            $attachments = explode(',', $data['attachments']);
        }
        $model->email_subject = $data['subject']; 
        $model->email_text_body = $data['email_body']; 
        $model->date_time = date('Y-m-d H:i:s'); 
        $model->attachments = json_encode($attachments); 
        $model->email_type = 'sent'; 
        $model->inquiry_id = $data['inquiry_id']; 
        $model->has_attachment = ($data['attachments']) ? 1 : 0; 
        $model->is_read = 1;
        return $model->save();
    }

    public function getInquiryEmails($id,$type = 'recieved') {
        return $this->allEmail->where('inquiry_id', '=', $id)->where('email_type', '=', $type)->orderBy('date_time', 'desc')->paginate(10);
    }

    public function getMoveToOptions() {
        $role = \App\common\helpers\User::getRoleName();
        if ($role == 'Admin') {
            return \App\Common\Models\Inquiry::select('id', 'inquiry_number')->where('inquiry_number', '!=', 'null')->get();
        }
        return false;
    }

    public function moveInquiryEmails($request) {
        if (!empty($request->id)) {
            if ($request->email_ids) {
                $ids = explode(',', $request->email_ids);
                foreach ($ids as $id) {
                    $model = '';
                    $model = $this->find($id);
                    if ($model) {
                        $model->inquiry_id = ($request->id == 'global') ? null : $request->id;
                        $model->save();
                    }
                }
                return \Illuminate\Support\Facades\Response::json(['success'=>true]);
            }
        }
        return \Illuminate\Support\Facades\Response::json(['success'=>false]);
    }

}
