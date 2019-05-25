<?php
/* * ********************************************************************************************************************* *//**
 *  Controller Name: InquiryDetailController.php
 *  Created: Seaquatic Team
 *  Description: This manages all the Inquiry Detail and Versioning funcitonality.Manages the ajax calls functions.
 * ************************************************************************************************************************* */

namespace App\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\Models\MasterCountry;
use App\Http\Requests\generalInquiryRequest;
use App\Common\Repositories\Base\MasterCountryRepositoryInterface;
use App\Common\Repositories\Base\InquiryDetailRepositoryInterface;
//use App\Common\Repositories\Base\uploadDirectoryRepositoryInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class InquiryDetailController extends Controller {

    protected $country;
    protected $inquiryDetail;
    //protected $uploadDirectory;
        
    public function __construct(MasterCountryRepositoryInterface $country, InquiryDetailRepositoryInterface $inquiryDetail)
    {   
            $this->country = $country;
            $this->inquiryDetail = $inquiryDetail;
            //$this->uploadDirectory = $uploadDirectory;
    }

    public function index() {
        return redirect()->home();
    }
    /**
     * Load quote inquiry form
     * 
     * @param $request (Object)
     * @return JSON
     */
    public function detailInquiry(Request $request) {
        $inquiryDetail = $this->inquiryDetail->loadQuoteDetail($request->id,$request)->paginate(10);
        return view('backend::inquiry-detail.index',['inquiryDetail' => $inquiryDetail,'id' => $request->id]);
    }
    /**
     * Load quote detail
     * 
     * @param $request (Object)
     * @return JSON
     */
    public function loadQuoteDetail(Request $request) {
        $inquiryDetail = $this->inquiryDetail->loadQuoteDetail($request->id,$request)->paginate(10);
        
        $html = View::make('backend::inquiry-detail._load_quote_detail', ['inquiryDetail' => $inquiryDetail])->render();
        return Response::Json(['html'=>$html]);
    }
    /**
     * create clone of a quote
     * 
     * @param $request (object)
     * @return JSON
     */
    public function cloneQuote(Request $request) {
        $returnData = $this->inquiryDetail->createClone($request);
        if (!empty($returnData)) {
            return Response::Json(['success' => true, 'message' => 'Inquiry is cloned successfully.']);
        } else {
            return Response::Json(['success' => false, 'message' => 'Something went wrong, Please try again later.']);
        }
        return Response::Json(['success' => false, 'message' => 'Inquiry not found.']);
    }
}
