<?php

namespace App\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\Models\MasterCountry;
use App\Http\Requests\generalInquiryRequest;
use App\Common\Models\Inquiry;
use App\Common\Repositories\Base\UserRepositoryInterface;
use App\Common\Repositories\Base\InquiryRepositoryInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use App\Backend\Http\Requests\passwordRequest;
use App\common\helpers\User;
use App\Backend\Http\Requests\profileRequest;

class MyProfileController extends Controller {
    
    protected $user;
        
    public function __construct(UserRepositoryInterface $user)
    {
            $this->user = $user;
    }

    public function index(){
        $user = $this->user->find(User::getId());
        return view('backend::my-profile.index',['user'=>$user]);
    }
    
    public function changePassword(passwordRequest $request){
        if($request){
            $res = $this->user->changePassword($request);
            if($res){
                return Response::Json(['success'=>true,'message'=>'Password changed successfully.']); 
            }
            return Response::Json(['success'=>false,'message'=>'Something went wrong, Please try again later.']); 
        }
    }
    
    public function updateProfile(profileRequest $request){
        if($request){
            $res = $this->user->updateProfile($request);
            if($res){
                return Response::Json(['success'=>true,'message'=>'Profile updated successfully.']); 
            }
            return Response::Json(['success'=>false,'message'=>'Something went wrong, Please try again later.']); 
        }
    }

}
