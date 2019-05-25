<?php

namespace App\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\Repositories\Base\AllEmailsRepositoryInterface;
use App\Common\Repositories\Base\DirectoryFilesRepositoryInterface;
use App\Common\Repositories\Base\uploadDirectoryRepositoryInterface;
use App\Common\Repositories\Base\InquiryRepositoryInterface;
use App\Backend\Http\Requests\globalSendMailRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

use Ddeboer\Imap\Server;
use Ddeboer\Imap\SearchExpression;
use Ddeboer\Imap\Search\Date\On;
use Ddeboer\Imap\Search\Date\After;
use DateTime;

class EmailsController extends Controller {
    
    protected $emails;
    protected $inquiry;
    protected $emailId;
    protected $password;
    protected $messageDetails;


    public function __construct(AllEmailsRepositoryInterface $emails,  DirectoryFilesRepositoryInterface $files, 
            uploadDirectoryRepositoryInterface $directory,
            InquiryRepositoryInterface $inquiry)
    {
            $this->emails = $emails;
            $this->inquiry = $inquiry;
            $this->files = $files;
            $this->directory = $directory;
            $this->emailId = 'dylan16taylor@gmail.com';
            $this->password = 'dylan@12345';
    }

    public function index(){
        
     return view('backend::emails.index');
     
    }
    
    public function loadEmails(Request $request){
        ini_set('max_input_time', 30000);
        ini_set('max_execution_time', 30000);
        
        $emails = $this->emails->searchEmails($request);
        $move_to = $this->emails->getMoveToOptions();
        
        $html = View::make('backend::emails._load-emails',['emails' => $emails,'move_to'=>$move_to])->render();
        return Response::Json(['html'=>$html]);
    }
    
    public function syncEmails(){
        $server = new Server('imap.gmail.com', '993', '/ssl/novalidate-cert');

        // $connection is instance of \Ddeboer\Imap\Connection
        $connection = $server->authenticate($this->emailId, $this->password);
        $lastSyncTime = $this->emails->getLastSyncTime();
        $search = new SearchExpression();
        if($lastSyncTime){
            $search->addCondition(new After(DateTime::createFromFormat('Y-m-d', date('Y-m-d',strtotime($lastSyncTime)))));
        }
        
        $mailbox = $connection->getMailbox('INBOX');
        $messages = $mailbox->getMessages($search);
        
        if(count($messages) > 0){
           $dd = $this->emails->syncEmails($messages);
        }
        return json_encode(['success'=>true]);
    }
    
    public function showEMailDetail(Request $request){
        
        $email = $this->emails->find($request->id);
        $html = View::make('backend::emails._load-emails-detail',['email' => $email])->render();
        return Response::Json(['html'=>$html]);
    }
    
    public function markAsRead(Request $request){
        $status = $this->emails->markAsRead($request->id);
        return Response::Json(['success'=>true]);
    }
    
    public function unreadCount($id = null){
        $count = $this->emails->unreadCount($id);
        return Response::Json(['success'=>true,'count'=>$count]);
    }
    
    public function globalSendMail(globalSendMailRequest $request){
        $data['request'] = 'send_normal_mail';
        $data['email'] = $request->email_to;//'dylan16taylor@gmail.com';
        $data['subject'] = $request->subject;
        $data['email_body'] = $request->email_body;
        $data['attachments'] = $request->attachments;
        $data['inquiry_id'] = (!empty($request->inquiry_id)) ? $request->inquiry_id : '';
        $res = \App\common\helpers\Utility::sendMail($data);
        $this->addToSendList($data);
        return Response::Json(['success'=>true,'message'=>'Mail sent successfully.']);
    }
    
    public function showFiles($qid){
        $inquiry = $this->inquiry->find($qid);
        $html = View::make('backend::emails._load-files',['inquiry' => $inquiry])->render();
        return Response::Json(['html'=>$html]);
    }
    
    public function addToSendList($data){
        return $status = $this->emails->addToSendList($data);
    }
    
    public function moveInquiryEmails(Request $request){
        return $this->emails->moveInquiryEmails($request);
    }
}


