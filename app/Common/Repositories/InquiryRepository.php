<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\InquiryRepositoryInterface; 
use App\Common\Models\Inquiry;
use App\common\helpers\User;

Class InquiryRepository implements InquiryRepositoryInterface
{
    protected $inquiry;
        
    public function __construct(Inquiry $inquiry)
    {
            $this->inquiry = $inquiry;
    }
    
   
    /**
     * find inquiry by id
     * @param type $id
     * @return mixed
     */
    public function find($id){
        return $this->inquiry->find($id);
    }
    
    /**
     * find inquiry list
     * @param type $id
     * @return mixed
     */
    public function findAll(){
        return $this->inquiry->all();
    }
    
    /**
     * find inquiry by condition
     * @param type $id
     * @return mixed
     */
    public function findBy($att, $value, $column = array('*')){
        return $this->inquiry->where($att, '=', $value);
    }
    
    /**
     * search || get list of inquiry type general
     * @param type $request
     * @return mixed
     */
    public function searchGeneralInquiry($request){
        
        $query = $this->inquiry->where(['status'=>'active','inquiry_type'=>'General']);
        if ($request->has('lead_value'))
        {
             $query->where('lead_value', '=', $request->lead_value);
        }
        if ($request->has('created_at'))
        {
            $date = date('Y-m-d', strtotime( $request->created_at ));
            $query->whereRaw('date(created_at) = ?',[$date]);
        }
        if ($request->has('keyword'))
        {
            $query->where(function ($q) use ($request)
            {
                return $q->where('first_name', 'LIKE', $request->keyword . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $request->keyword . '%');
            });
        }
        return $query;
    }
    /**
     * Search quote inquiry data
     * 
     * @param $request (Object)
     * @return $query
     */
    public function searchQuoteInquiry($request){
        
        $query = $this->inquiry->where(['status'=>'active','inquiry_type'=>'Quotation']);
        if ($request->has('lead_value'))
        {
             $query->where('lead_value', '=', $request->lead_value);
        }
        if ($request->has('created_at'))
        {
            $date = date('Y-m-d', strtotime( $request->created_at ));
            $query->whereRaw('date(created_at) = ?',[$date]);
        }
        if (User::getRoleName() == 'Estimator')
        {
            $query->where('quote_inquiry_status','=','Engineering');
        }
        if ($request->has('keyword'))
        {
            $query->where(function ($q) use ($request)
            {
                return $q->where('first_name', 'LIKE', $request->keyword . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $request->keyword . '%');
            });
        }
        return $query;
    }
    
    /**
     * search || get list of inquiry type trash
     * @param type $request
     * @return mixed
     */
    public function searchTrashInquiry($request){
        
        $query = $this->inquiry->where('status', '=', 'deleted');
        if ($request->has('created_at'))
        {
            $date = date('Y-m-d', strtotime( $request->created_at ));
            $query->whereRaw('date(created_at) = ?',[$date]);
        }
        if ($request->has('keyword'))
        {
            $query->where(function ($q) use ($request)
            {
                return $q->where('first_name', 'LIKE', $request->keyword . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $request->keyword . '%');
            });
        }
        return $query;
    }
    
    
    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*')) {
        return $this->inquiry->paginate($perPage, $columns);
    }
    
    /**
     * Save the General Inquiry.
     *
     * @param Post $post
     *
     * @return bool
     */
    public function createOrUpdate($post,$type = null)
    {
        if(!empty($post->id)){
            $this->inquiry = $this->inquiry->find($post->id);
        }else{
            if(User::checkLogin()){
                $this->inquiry->created_by = User::getId();
            };
        }
        $this->inquiry->first_name  = $post->first_name;
        $this->inquiry->last_name   = $post->last_name;
        $this->inquiry->email       = $post->email;
        $this->inquiry->phone       = $post->phone;
        $this->inquiry->mobile      = $post->mobile;
        $this->inquiry->fax         = $post->fax;
        $this->inquiry->website     = $post->website;
        $this->inquiry->company_name = $post->company_name;
        if($type){
            $this->inquiry->inquiry_type = $type;
        }
        $this->inquiry->country_id  = $post->country_id;
        $this->inquiry->state       = $post->state;
        $this->inquiry->address     = $post->address;
        $this->inquiry->zipcode     = $post->zipcode;
        $this->inquiry->comment     = $post->comment;
        $this->inquiry->alternet_email     = $post->alternet_email;
        if(isset($post->city)){
            $this->inquiry->city = $post->city;
        }
        if(isset($post->project_name)){
            $this->inquiry->project_name = $post->project_name;
        }
        if(isset($post->lead_value)){
            $this->inquiry->lead_value = $post->lead_value;
        }
        if($this->inquiry->save()) {
            return $this->inquiry->id;
        } else {
            return false;
        }
    }
    
    /**
     * update status of a inquiry
     * @param type $id
     * @param type $post
     * @return bool
     */
    public function toggleStatus($id,$post){
        $data = array();
        if($post->type == 'trash'){
            $data['status'] = $post->status;
        }else if($post->type == 'general'){
            $data['general_inquiry_status'] = $post->status;
        }else if($post->type == 'quotation'){
             $data['quote_inquiry_status'] = $post->status;
        }
        return $this->inquiry->where('id', $id)->update($data);
    }
    
    /**
     * get dashboard statics data
     * @return mixed
     */
    public function loadGeneralInquiryStatics(){
        $recieved = $this->inquiry->where('inquiry_type', 'general')->count();
        $pending = $this->inquiry->where(['inquiry_type'=>'general','general_inquiry_status'=>'pending'])->where('status','!=','deleted')->count();
        $solved = $this->inquiry->where(['inquiry_type'=>'general','general_inquiry_status'=>'solved'])->where('status','!=','deleted')->count();
        $trash = $this->inquiry->where(['inquiry_type'=>'general','status'=>'deleted'])->count();
        $statics = ['total_recieved'=>$recieved,'total_pending'=>$pending,'total_solved'=>$solved,'total_trash'=>$trash];
        return $statics;
    }
    
     /**
     * get dashboard statics data
     * @return mixed
     */
    public function loadQuoteInquiryStatics(){
        $recieved = $this->inquiry->where('inquiry_type', 'quotation')->count();
        $pending = $this->inquiry->where(['inquiry_type'=>'quotation','quote_inquiry_status'=>'Pending'])->where('status','!=','deleted')->count();
        $won = $this->inquiry->where(['inquiry_type'=>'quotation','general_inquiry_status'=>'Won'])->where('status','!=','deleted')->count();
        $lost = $this->inquiry->where(['inquiry_type'=>'quotation','general_inquiry_status'=>'Lost'])->where('status','!=','deleted')->count();
        $submitted = $this->inquiry->where(['inquiry_type'=>'quotation','general_inquiry_status'=>'Submitted'])->where('status','!=','deleted')->count();
        $estimating = $this->inquiry->where(['inquiry_type'=>'quotation','general_inquiry_status'=>'Engineering'])->where('status','!=','deleted')->count();
        $statics = ['total_recieved'=>$recieved,'total_pending'=>$pending,'total_submitted'=>$submitted,'total_estimating'=>$estimating,'total_won'=>$won,'total_lost'=>$lost];
        return $statics;
    }
    
    
    /**
     * delete a inquiry
     * @param type $id
     * @return bool
     */
    public function deleteInquiry($id){
       //$inq =  $this->inquiry->find($id);
       return $this->inquiry->destroy($id);
    }
    
    /**
     * delete a inquiry
     * @param type $id
     * @return bool
     */
    public function assignSalesRep($id,$type){
       $inq =  $this->inquiry->find($id);
       if($inq){
            $inq->assigned_to     = 3;
            $inq->inquiry_number     = str_pad($id, 4, '0', STR_PAD_LEFT); 
            if($type == 'quotation'){
                $inq->inquiry_number     = 'BR.'. str_pad($id, 2, '0', STR_PAD_LEFT); 
            }
            return $inq->Save();
       }
       return false;
    }
    
     public function getSalesRepRoundRobin($id){
         
     }
}
