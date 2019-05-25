<?php

namespace App\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\generalInquiryRequest;
use App\Common\Repositories\Base\MasterCountryRepositoryInterface;
use App\Common\Repositories\Base\InquiryRepositoryInterface;
use App\Common\Repositories\Base\uploadDirectoryRepositoryInterface;
use App\Common\Repositories\Base\DirectoryFilesRepositoryInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use App\Backend\Http\Requests\uploadRequest;

class DirectoryController extends Controller {

    protected $inquiry;
    protected $uploadDirectory;
    protected $uploadFiles;

    public function __construct(InquiryRepositoryInterface $inquiry, uploadDirectoryRepositoryInterface $uploadDirectory, DirectoryFilesRepositoryInterface $uploadFiles) {
        $this->inquiry = $inquiry;
        $this->uploadDirectory = $uploadDirectory;
        $this->directoryFiles = $uploadFiles;
    }

    public function index() {

        return redirect()->home();
    }

    public function create(Request $request) {
        $status = $this->uploadDirectory->create($request);
        if (!empty($status)) {
            return Response::Json(['success' => true, 'message' => 'Directory has been created successfully.']);
        } else {
            return Response::Json(['success' => false, 'message' => 'Something went wrong, Please try again later.']);
        }
    }

    public function toggleStatus(Request $request) {
        $inquiry = $this->inquiry->find($request->id);
        if (!empty($inquiry)) {
            $status = $this->inquiry->toggleStatus($request->id, $request);
            if ($status) {
                return Response::Json(['success' => true, 'message' => 'Inquiry moved to trash successfully.']);
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

    public function loadFileSection($id) {
        $inquiry = $this->inquiry->find($id);
        if ($inquiry) {
            $directory = $this->uploadDirectory->findAllByInquiryId($inquiry->id);
            $html = View::make('backend::inquiry.quotation._load_file_section', ['directory' => $directory,'inquiry' => $inquiry])->render();
            return Response::Json(['html' => $html]);
        }
        return Response::Json(['html' => false, 'message' => 'Inquiry not found.']);
    }

    public function uploadFiles($id) {
        $directory = $this->uploadDirectory->find($id);
        if ($directory) {
            $directory = $this->uploadDirectory->findAllByInquiryId($inquiry->id);
            $html = View::make('backend::inquiry.quotation._load_file_section', ['directory' => $directory])->render();
            return Response::Json(['html' => $html]);
        }
        return Response::Json(['html' => false, 'message' => 'Directory not found.']);
    }

    public function media($id) {
        $directory = $this->uploadDirectory->find($id);
        if($directory){
            return view('backend::directory.files', ['directory_id' => $id,'directory_name'=>$directory->directory_name]);
        }
        return redirect()->back();
    }

    /**
     * 
     * @param type $id
     * @return File Directory 
     */
    public function loadFileDirectory($id) {
        $files = $this->directoryFiles->FindAllByDirectoryFiles($id);
        $html = View::make('backend::directory._uploadfiles_directory', ['files' => $files])->render();
        return Response::Json(['html' => $html]);
    }

    /**
     * 
     * @param uploadRequest $request
     * @return upload files in directory
     */
    public function uploadFileInDirectory(uploadRequest $request) {
        $directory = $this->uploadDirectory->find($request->directory_id);
        if ($directory) {
            $status = $this->directoryFiles->uploadFileInDirectory($request, $directory);
            if ($status) {
                return Response::Json(['success' => true, 'message' => 'Upload File In Directory  successfully.']);
            } else {
                $errors = ['success' => false, 'message' => 'Something went wrong, Please try again later.'];
                return response()->json($errors, 422);
            }
        }
        return Response::Json(['success' => false, 'message' => 'Directory not found.']);
    }

    /**
     * 
     * @param type $id
     *  Delete Upload Directory file
     */
    public function DeleteUploadedFiles($id) {
        $filedirectory = $this->directoryFiles->find($id);
        if (!empty($filedirectory)) {
            $deleted = $this->directoryFiles->deleteFileDirectorys($id);
            if ($deleted) {
                return Response::Json(['success' => true, 'message' => 'file directorys deleted successfully.']);
            } else {
                return Response::Json(['success' => false, 'message' => 'Something went wrong, Please try again later.']);
            }
        }
        return Response::Json(['success' => false, 'message' => 'File not found.']);
    }

    /**
     * 
     * @param Request $request
     * return file name rename 
     */
    
    public function directoryFileRename(Request $request) {
        if (!empty($request->file_title)) {
            $fileName = $this->directoryFiles->findByFileName($request);
            if (empty($fileName)) {
                $file_title_updated = $this->directoryFiles->fileNameRename($request);
                 if($file_title_updated){
                      return Response::Json(['success' => true, 'message' => 'file rename successfully']);
                 }else{
                     return Response::Json(['success' => false, 'message' => 'Something went wrong, Please try again later.']);
                 }
            } else {
                return Response::Json(['success' => false, 'message' => 'file name hase ben already exist']);
            }
        } else {
            return Response::Json(['success' => false, 'message' => 'FileName cannot be blank.']);
        }
    }

}
