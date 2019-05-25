<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\generalInquiryRequest;
use App\Common\Repositories\Base\MasterCountryRepositoryInterface;
use App\Common\Repositories\Base\InquiryRepositoryInterface;
use App\Common\Repositories\Base\PanelsRepositoryInterface;
use App\Common\Repositories\Base\MasterFieldRepositoryInterface;
use App\Common\Repositories\Base\TReferenceTableRepositoryInterface;
use App\Common\Repositories\Base\InquiryDetailRepositoryInterface;
use App\Common\Models\PanelSetting;
use App\Common\Panels\PanelFactory;
use Illuminate\Support\Facades\Session;

class InquiryController extends Controller {

    protected $country;
    protected $inquiry;
    protected $panel;
    protected $masterField;
    protected $panelClass;
    protected $tReference;
    protected $panelSetting;
    protected $inquiryDetail;

    public function __construct(MasterCountryRepositoryInterface $country, InquiryRepositoryInterface $inquiry, PanelsRepositoryInterface $panel, MasterFieldRepositoryInterface $masterField, TReferenceTableRepositoryInterface $tReference, PanelSetting $panelSetting, InquiryDetailRepositoryInterface $inquiryDetail) {
        $this->country = $country;
        $this->inquiry = $inquiry;
        $this->panel = $panel;
        $this->masterField = $masterField;
        $this->tReference = $tReference;
        $this->panelSetting = $panelSetting;
        $this->inquiryDetail = $inquiryDetail;
    }

    public function index() {
        return redirect('/inquiry/general');
    }
    
    
    public function general() {
        Session::forget('quote_id');
        $countries = $this->country->findAll();
        return view('general', ['countries' => $countries]);
    }
    
    public function quotation() {
        if(Session::get('quote_id')){
            flash()->success('Success! Inquiry submitted successfully. We will contact you soon.');
        };
        Session::forget('quote_id');
        $countries = $this->country->findAll();
        return view('quotation', ['countries' => $countries]);
    }

    /**
     * Creates a new post.
     *
     * @return string
     */
    public function create(generalInquiryRequest $request) {
        $id = $this->createOrUpdate($request,'general');
        if ($id) {
            $this->inquiry->assignSalesRep($id,'general');
            flash()->success('Success! Inquiry submitted successfully.');
        } else {
            flash()->error('Woops! Something went wrong, Please try again later.');
        }
        return redirect()->back();
    }

    /**
     * Creates a new post.
     *
     * @return string
     */
    public function choosePanel(generalInquiryRequest $request) {
        
        Session::put('inquiry_data', $request->all());
        $panels = $this->panel->findAll();
        return view('panel_selection', ['panels' => $panels]);
        
    }
    
    /**
     * Creates a new post.
     *
     * @return string
     */
    public function choosePanelGet() {
        if (Session::get('quote_id')) {
            $panels = $this->panel->findAll();
            return view('panel_selection', ['panels' => $panels]);
        }
        return redirect()->to('/');
        
    }

    public function panelDetails($id) {
        
        if (Session::get('inquiry_data') || Session::get('quote_id')) {
            $panel = $this->panel->find($id);
            if ($panel) {
                $panelFields = $panel->fields->first()->toArray();
                $masterFields = $this->masterField->findAll();
                $panelImages = $panel->images->toArray();

                return view('panel_details', compact('panel', 'panelFields', 'panelImages', 'masterFields'));
            }
        }
        return redirect()->to('/');
//        return redirect()->back();
    }

    public function submitQuoteInquiry(Request $request) {
        
        if ($request && !empty($request->panel_id)) {
            $panel = $this->panel->find($request->panel_id);
            $exceptIds = array(10,11,12,13);
            if ($panel) {
                if($request->wind_mitigation == 0 && !in_array($request->panel_id, $exceptIds) ) {
                    $amount = $this->getQuotationAmount($request);
                } else {
                    $amount = 0;
                } 
                
                    if(Session::get('quote_id')){
                        
                        $quote_id = Session::get('quote_id');
                    }else{
                        $quote_id = $this->createOrUpdate((object) Session::get('inquiry_data'),'quotation');
                        $this->inquiry->assignSalesRep($quote_id,'quotation');
                        Session::put('quote_id',$quote_id);
                        Session::forget('inquiry_data');
                    }
                    if ($quote_id) {
                        
                        $inquiryDetail = $this->savePanelDetails($request, $quote_id, $amount);
                        $res = $this->inquiryDetail->updateQuoteStatus($quote_id);
                        if($inquiryDetail){
                            flash()->warning('Success! Inquiry submitted successfully.');
                            return redirect()->to('/inquiry/create/panel-details/'.$request->panel_id);
                        }
                        
                    }
            } else {
                
                \App::abort(404, 'Invalid panel Id.');
            }
        }
    }

    public function getQuotationAmount($request) {
        $this->panelClass = PanelFactory::getPanelClass($request, $request->panel_id);
        //$amount = $this->panelClass->calculateCost();
        return $this->panelClass->calculateCost();
        //dd($amount);
    }

    public function savePanelDetails($request, $quote_id, $amount) {
        return $this->inquiryDetail->createOrUpdate($request, $quote_id, $amount);
    }

    public function createOrUpdate($post,$type) {
        return $this->inquiry->createOrUpdate($post,$type);
    }

}
