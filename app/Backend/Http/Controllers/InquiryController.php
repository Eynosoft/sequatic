<?php
namespace App\Backend\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\generalInquiryRequest;
use App\Common\Repositories\Base\MasterCountryRepositoryInterface;
use App\Common\Repositories\Base\InquiryRepositoryInterface;
use App\Common\Repositories\Base\uploadDirectoryRepositoryInterface;
use App\Common\Repositories\Base\InquiryDetailRepositoryInterface;
use App\Common\Repositories\Base\AllEmailsRepositoryInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
class InquiryController extends Controller {
    protected $country;
    protected $inquiry;
    protected $inquiryDetail;
    protected $uploadDirectory;
    protected $emails;
    public function __construct(MasterCountryRepositoryInterface $country, InquiryRepositoryInterface $inquiry, 
            uploadDirectoryRepositoryInterface $uploadDirectory,
            InquiryDetailRepositoryInterface $inquiryDetail,
            AllEmailsRepositoryInterface $emails) {
        $this->country = $country;
        $this->inquiry = $inquiry;
        $this->emails = $emails;
        $this->inquiryDetail = $inquiryDetail;
        $this->uploadDirectory = $uploadDirectory;
    }
    public function index() {
        //return view('backend::trash.index');
        return redirect()->home();
    }
    public function trash() {
        return view('backend::trash.index');
    }
    public function loadTrashInquiry(Request $request) {
        $inquiries = $this->inquiry->searchTrashInquiry($request)->paginate(10);
        $html = View::make('backend::trash._load-trash-inquiry', ['inquiries' => $inquiries])->render();
        return Response::Json(['html' => $html]);
    }
    /**
     * Load quote inquiry form
     * 
     * @param $request (Object)
     * @return JSON
     */
    public function quotation(Request $request) {
        return view('backend::inquiry.quotation.index');
    }
    /**
     * Load quote inquiry form
     * 
     * @param $request (Object)
     * @return JSON
     */
    public function loadQuoteInquiry(Request $request) {
        $inquiries = $this->inquiry->searchQuoteInquiry($request)->paginate(10);
        $html = View::make('backend::inquiry.quotation._load_quote_inquiry', ['inquiries' => $inquiries])->render();
        return Response::Json(['html' => $html]);
    }
    public function toggleStatus(Request $request) {
        $inquiry = $this->inquiry->find($request->id);
        if (!empty($inquiry)) {
            $status = $this->inquiry->toggleStatus($request->id, $request);
            if ($status) {
                if ($request->type == 'trash') {
                    return Response::Json(['success' => true, 'message' => 'Inquiry moved to trash successfully.']);
                } else {
                    return Response::Json(['success' => true, 'message' => 'Status updated successfully.']);
                }
            } else {
                return Response::Json(['success' => false, 'message' => 'Something went wrong, Please try again later.']);
            }
        }
        return Response::Json(['success' => false, 'message' => 'Inquiry not found.']);
    }
    public function delete($id) {
        $inquiry = $this->inquiry->find($id);
        if (!empty($inquiry)) {
            $status = $this->inquiry->deleteInquiry($id);
            if ($status) {
                return Response::Json(['success' => true, 'message' => 'Inquiry deleted successfully.']);
            } else {
                return Response::Json(['success' => false, 'message' => 'Something went wrong, Please try again later.']);
            }
        }
        return Response::Json(['success' => false, 'message' => 'Inquiry not found.']);
    }
    public function edit($id, $vId) {
        if ((int) $id && (int) $vId) {
            $inquiry = $this->inquiry->find($id);
            $Panels = $this->inquiryDetail->findByVersion($id,$vId);
            if (count($inquiry) > 0 && count($Panels) > 0) {
                $countries = $this->country->findAll();
                if ($inquiry->inquiry_type == 'General') {
                    return view('backend::inquiry.general.edit', ['countries' => $countries, 'inquiry' => $inquiry]);
                } else {
                    return view('backend::inquiry.quotation.edit', ['countries' => $countries, 'inquiry' => $inquiry,'version_id'=>$vId,'quote_id'=>$id]);
                }
            }
            abort(404);
        }
        abort(404);
    }
    
    public function generalEdit($id) {
        if ((int) $id) {
            $inquiry = $this->inquiry->find($id);
            if (count($inquiry) > 0) {
                $countries = $this->country->findAll();
                if ($inquiry->inquiry_type == 'General') {
                    return view('backend::inquiry.general.edit', ['countries' => $countries, 'inquiry' => $inquiry,'quote_id'=>$id]);
                }
            }
            abort(404);
        }
        abort(404);
    }
    
    
    function getInquiryForm($id) {
        $inquiry = $this->inquiry->find($id);
        if (!empty($inquiry)) {
            $countries = $this->country->findAll();
            return View::make('backend::inquiry.quotation._inquiry_form', ['countries' => $countries, 'inquiry' => $inquiry])->render();
        }
    }
    function getPanelsSection($id,$vId) {
        $Panels = $this->inquiryDetail->findByVersion($id,$vId);
        $html = View::make('backend::inquiry.quotation._panels',['panels'=>$Panels])->render();
        return Response::Json(['html' => $html]);
    }
    function getEmailSection($id,$type = 'recieved') {
        
        if($id){
            $inqType = '';
            $inquiry = $this->inquiry->find($id);
            if(!empty($inquiry)){
                $inqType = $inquiry->inquiry_type;
            }
            $emails = $this->emails->getInquiryEmails($id,$type);
            $move_to = $this->emails->getMoveToOptions();
            $html = View::make('backend::inquiry.quotation._email',['emails'=>$emails,'move_to'=>$move_to,'email_type'=>$type,'inquiry_type'=>$inqType,'quote_id'=>$id])->render();
            return Response::Json(['html' => $html]);
        }
    }
    /**
     * Creates pr update a inquiry.
     *
     * @return string
     */
    public function update(generalInquiryRequest $request) {
        if ($this->inquiry->createOrUpdate($request)) {
            return Response::Json(['success' => true, 'message' => 'Success! Inquiry updated successfully.']);
        } else {
            return Response::Json(['success' => true, 'message' => 'Woops! Something went wrong, Please try again later.']);
        }
        return redirect()->back();
    }
}
