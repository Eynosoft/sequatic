<?php

namespace App\Common\Repositories;

use App\Common\Repositories\Base\DirectoryFilesRepositoryInterface;
use App\Common\Models\DirectoryFiles;
use File;

Class DirectoryFilesRepository implements DirectoryFilesRepositoryInterface {

    protected $directoryFiles;

    public function __construct(DirectoryFiles $uploadFiles) {
        $this->directoryFiles = $uploadFiles;
    }
    
    
    public function FindAllByDirectoryFiles($id){
        return $this->directoryFiles->where('directory_id', '=', $id)->get();
     }
     
     public function find($id){
        return $this->directoryFiles->find($id);
    }
    
    /**
     * 
     * @param type $id
     * @return deleted file directoryrsponse 
     */
    
    public function deleteFileDirectorys($id){
      return $this->directoryFiles->destroy($id);
    }  
    
    /**
     * 
     * @param type $request
     * find file title name  
     */
    public function findByFileName($request){
        return $this->directoryFiles->where(['directory_id' => $request->directory_id , 'file_title' => $request->file_title])->first();
    }
    
    /**
     * 
     * @param type $request
     * @param type $directory
     * @return boolean
     */
    
    public function uploadFileInDirectory($request, $directory) {
        $temp_path = public_path()."/images/" . $directory->inquiry_id . '/';
        if (!is_dir($temp_path)) {
            mkdir($temp_path, 0775, true);
        }
        $direc_path = $temp_path . $directory->id . '/';
        //$direc_path = $temp_path . $directory->directory_name . '/';
        if (!is_dir($direc_path)) {
            //dd($direc_path);
            mkdir($direc_path, 0775, true);
        }
        //base_path() .
        $extension = $request->file('file')->getClientOriginalExtension();
        $fileName = rand(11111, 99999) . '.' . $extension;
        $request->file('file')->move($direc_path, $fileName);
        $this->directoryFiles->directory_id = $request->directory_id;
        $this->directoryFiles->file_path = '/images/'.$directory->inquiry_id.'/'.$directory->id.'/'.$fileName;
        $this->directoryFiles->file_title = $fileName;
        if ($this->directoryFiles->save()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * @param type $request
     * @return file title rename
     */
    
    public function fileNameRename($request){
       $file_title =  $this->find($request->id);
       $file_title->file_title = $request->file_title;
       if($file_title->save()){
           return true;
       }else{
           return false;
       }
    }
}
