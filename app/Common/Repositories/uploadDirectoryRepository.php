<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\uploadDirectoryRepositoryInterface; 
use App\Common\Models\uploadDirectory;

Class uploadDirectoryRepository implements uploadDirectoryRepositoryInterface
{
    protected $uploadDirecotry;
        
    public function __construct(uploadDirectory $uploadDirecotry)
    {
            $this->uploadDirecotry = $uploadDirecotry;
    }
    
    /**
     * find upload directory by unique id
     * @param type $id
     * @return type mixed
     */
    public function find($id){
        return $this->uploadDirecotry->find($id);
    }
    
    /**
     * find all directory list
     * @return mixed 
     */
    public function findAll(){
        return $this->uploadDirecotry->all();
    }
    
    /**
     * find directory by condition
     * @return mixed 
     */
    public function findBy($att, $value, $column = array('*')){
        return $this->uploadDirecotry->where($att, '=', $value)->get();
    }
    
    /**
     * find alldirecotry by inquiry id
     * @param type $id
     * @return type mixed
     */
    public function findAllByInquiryId($id){
        return $this->uploadDirecotry->where('inquiry_id', '=', $id)->where('status','=','active')->get();
    }
    
    
    /**
     * Save the General Inquiry.
     * @param Post $post
     * @return bool
     */
    public function create($post)
    {
        $this->uploadDirecotry->directory_name  = $post->directory_name;
        $this->uploadDirecotry->status     = 'active';
        $this->uploadDirecotry->inquiry_id     = $post->inquiry_id;
        
        if ($this->uploadDirecotry->save()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Toggle status of General Inquiry.
     * @param type $id
     * @param type $post
     * @return type $model
     */
    public function toggleStatus($id,$post){
        
        $data = array();
        $data['status'] = $post->status;
        
        return $this->uploadDirecotry->where('id', $id)->update($data);
    }
    
    /**
     * delete a directory
     * @param type $id
     * @return type bool
     */
    public function deleteDirectory($id){
       //$inq =  $this->inquiry->find($id);
       return $this->uploadDirecotry->destroy($id);
    }
    
}
