<?php

namespace App\Backend\Http\Controllers\Auth;

use App\Backend\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Backend\Http\Requests\forgotRequest;
use App\Common\Repositories\Base\UserRepositoryInterface;
use App\Backend\Http\Requests\resetPasswordRequest;
use App\common\helpers\Utility;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $user;
    
    public function __construct(UserRepositoryInterface $user)
    {
        $this->middleware('guest');
        $this->user = $user;
    }
    
    /**
     * 
     * @param forgotRequest $request
     */
    
    /**
     * 
     * @return type
     */
    public function index()
    {
        return view('backend::auth.forgot-password');
    }
    
    public function forgotPasswordSubmit(forgotRequest $request)
    {
        if($request->has('email')){
            $Modal = $this->user->findByEmail($request->email);
            if(!empty($Modal)){
                $token = $this->saveToken($Modal);
                $data = array();
                $data['request'] = 'forgot_password';
                $data['email'] = $request->email;//'dylan16taylor@gmail.com';
                $data['name'] = $Modal->first_name.' '.$Modal->last_name;
                $data['subject'] = 'Rest Password Link';
                $data['link'] = url('backend/forgot-password/reset/'.$token);
                if(Utility::sendMail($data)){
                  flash()->success('Please check your mail for further instructions.');
                  return redirect('/backend/login');
                }
                 flash()->error('Something went wrong, Please try after sometime.');
                  return redirect('/backend/forgot-password');
            }
        }
    }
    
    public function saveToken($Modal){
            $token =  str_random(30);
            $Modal->reset_token = $token;
            if($Modal->save()){
                return $token;
            }
            return false;
    }
    
    public function Reset($token)
    {
        if($token){
            $Modal = $this->user->findByToken($token);
            if(!empty($Modal)){
                return view('backend::auth.reset-password',['token'=>$token]);
            }
            return redirect('/backend/login');
        }
    }
    
    public function resetPassword(resetPasswordRequest $request)
    {
        if(!empty($request->reset_token)){
            $Modal = $this->user->findByToken($request->reset_token);
            if(!empty($Modal)){
                $Modal->password = bcrypt($request->password);
                $Modal->reset_token = null;
                if($Modal->save()){
                    flash()->success('Password reset Successfully. Please login here.');
                }
                     flash()->error('Something went wrong, Please try after sometime.');
                 }
                 return redirect('/backend/login');
            }
        }
    }
