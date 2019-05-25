<?php

namespace App\Common\Repositories\Base;

interface DirectoryFilesRepositoryInterface
{
    public function uploadFileInDirectory($request,$directory);
    
    public function FindAllByDirectoryFiles($id);
    
    public function find($id);
    
    public function deleteFileDirectorys($id);
    
    public function findByFileName($request);
    
    public function fileNameRename($request);
   
}
