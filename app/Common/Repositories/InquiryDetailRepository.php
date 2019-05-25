<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\InquiryDetailRepositoryInterface; 
use App\Common\Models\InquiryDetail;
use App\Common\Models\Inquiry;

Class InquiryDetailRepository implements InquiryDetailRepositoryInterface
{
    protected $inquiryDetail;
        
    public function __construct(InquiryDetail $inquiryDetail)
    {
            $this->inquiryDetail = $inquiryDetail;
    }
    
    /**
     * 
     */
    
    public function find($id){
        return $this->inquiryDetail->find($id);
    }
    
    /**
     * 
     * @return mixed 
     */
    public function findAll(){
        return $this->inquiryDetail->all();
    }

    public function findBy($att, $value, $column = array('*')){
        return $this->inquiryDetail->where($att, '=', $value);
    }
    
    public function findByVersion($panel_id,$version_id){
        return $this->inquiryDetail->where('quote_id', '=', $panel_id)->where('version_number', '=', $version_id)->get();
    }
    
    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*')) {
        return $this->inquiryDetail->paginate($perPage, $columns);
    }
    
    /**
     * Save the General Inquiry.
     * @param Post $post
     * @return bool
     */
    public function createOrUpdate($post,$quote_id = 1,$amount = 0)
    {   
        if(!empty($post->id)){
            $this->inquiryDetail = $this->inquiryDetail->find($post->id);
        }
        $this->inquiryDetail->panel_id  = $post->panel_id;
        $this->inquiryDetail->quote_id  = $quote_id;
        $this->inquiryDetail->field_data   = json_encode((array) $post->all());
        $this->inquiryDetail->amount   = $amount;
        if ($this->inquiryDetail->save()) {
            return $this->inquiryDetail->id;
        } else {
            return false;
        }
    }
    
    /**
     * Create clone Inquiry.
     * @param $request (object)
     * @return id|false
     */
    public function createClone($post = null)
    {    
        $detailData = $this->inquiryDetail->where(['quote_id' => $post->id])->orderby('updated_at','DESC')->get();
        if(count($detailData) > 0) {
            $count = 0;
            foreach($detailData as $data) {
                $model = '';
                $model = new $this->inquiryDetail;
                $model->panel_id  = $data->panel_id;
                $model->quote_id  = $data->quote_id;
                $model->field_data   = $data->field_data;
                $model->amount   = $data->amount;
                $model->version_number = $data->version_number + 1;
                if($model->save()){
                    $count++;
                }else{
                    dd($model);
                }
            }
            return true;
        } else {
            return false;
        }
    }
    /**
     * load the details of quote
     * 
     * @param $id,$version_number
     * @return 
     */
    public function loadQuoteDetail($id = null,$request = null) {
        $query = $this->inquiryDetail->where(['quote_id'=>$id]);
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
        $query = $query->groupBy('version_number');
        return $query;
    }
    
    public function updateQuoteStatus($id) {
        $res = $this->inquiryDetail->where(['quote_id'=>$id])->where('amount','<', 1)->get();
        if($res && count($res) > 0){
           
           $inq = Inquiry::find($id);
            if($inq){
                $inq->quote_inquiry_status = 'Engineering';
                $inq->Save();
            }
        }
    }
    
    
    
}
