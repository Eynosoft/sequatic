<?php
namespace App\Backend\Http\Controllers;
use Illuminate\Http\Request;
use App\Common\Models\MasterCountry;
use App\Http\Requests\generalInquiryRequest;
use App\Common\Models\Inquiry;
use App\Common\Repositories\Base\MasterCountryRepositoryInterface;
use App\Common\Repositories\Base\InquiryRepositoryInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
class DashboardController extends Controller {
    
    protected $inquiry;
        
    public function __construct(InquiryRepositoryInterface $inquiry)
    {
            $this->inquiry = $inquiry;
    }
    public function index(){
        return view('backend::inquiry.general.index');
    }
    
    public function loadGeneralInquiry(Request $request){
        
     $inquiries = $this->inquiry->searchGeneralInquiry($request)->paginate(10);
     $html = View::make('backend::inquiry.general._load-general-inquiry',['inquiries' => $inquiries])->render();
     return Response::Json(['html'=>$html]);
    }
    
    public function loadGeneralInquiryStatics(Request $request){
     $statics = $this->inquiry->loadGeneralInquiryStatics();
     //$html = View::make('backend::dashboard._load-general-inquiry-statics',['statics' => $statics])->render();
     return Response::Json($statics);
    }
    
    public function loadQuoteInquiryStatics(Request $request){
     $statics = $this->inquiry->loadQuoteInquiryStatics();
     //$html = View::make('backend::dashboard._load-general-inquiry-statics',['statics' => $statics])->render();
     return Response::Json($statics);
    }
    
    public function testImap(){
        $mailbox = new \PhpImap\Mailbox('{imap.gmail.com:993/imap/ssl}INBOX', 'dylan16taylor@gmail.com', 'dylan@12345',  public_path().'/attachments');
        
        // Read all messaged into an array:
        $mailsIds = $mailbox->searchMailbox('ALL');
        if(!$mailsIds) {
                die('Mailbox is empty');
        }
        // Get the first message and save its attachment(s) to disk:
        $mail = $mailbox->getMail($mailsIds[407]);
        //echo $mail->textHtml;
        dd($mail);
        echo "\n\n\n\n\n";
        //dd($mail->getAttachments());
    }
}
