<?php

namespace App\Backend\Http\Controllers\Auth;

use App\Backend\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Backend\Http\Requests\loginRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Common\Repositories\Base\UserRepositoryInterface;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/backend';
    
    protected $guard = 'backend';
    
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
        $this->middleware('guest')->except('logout');
    }
    
    public function index()
    {
        return view('backend::auth.login');
    }
    
    // protected $redirectTo = '/';
    public function redirectPath()
    {
        // return desired URL
        return '/backend';
    }
    
    
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function login(loginRequest $request)
    {   
        $data = array();
        $data['status'] = 'active';
        $data['email'] = $request->email;
        $data['password'] = $request->password;
         if (Auth::guard('backend')->attempt($data,$request->remember)) {             
            return $this->sendLoginResponse($request);
        }
        return $this->sendFailedLoginResponse($request);
    }
    
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('backend')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/backend');
    }
    
}
