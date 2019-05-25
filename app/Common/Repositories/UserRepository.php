<?php
namespace App\Common\Repositories;
use App\Common\Repositories\Base\UserRepositoryInterface;
use App\Common\Models\User;
use Illuminate\Support\Facades\Auth;
use App\common\helpers\User as webUser;
use Illuminate\Support\Facades\Hash;
Class UserRepository implements UserRepositoryInterface {
    protected $user;
    public function __construct(User $user) {
        $this->user = $user;
    }
    /**
     * find inquiry by id
     * @param type $id
     * @return mixed
     */
    public function find($id) {
        return $this->user->find($id);
    }
    /**
     * Change password
     * @param type $request
     * @return boolean
     */
    public function changePassword($request) {
        if ($request) {
            $user = $this->find(webUser::getId());
            if ($user && Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->password);
                ;
                return $user->save();
            }
            return false;
        }
    }
    /**
     * Update profile
     * @param type $request
     * @return boolean
     */
    public function updateProfile($request) {
        if ($request) {
            $user = $this->find(webUser::getId());
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            return $user->save();
        }
        return false;
    }
    
    
    /**
     * find inquiry by id
     * @param type $id
     * @return mixed
     */
    public function findByEmail($email) {
        return $this->user->where(['email' => $email])->first();
    }
    
    /**
     * find inquiry by id
     * @param type $id
     * @return mixed
     */
    public function findByToken($token) {
        return $this->user->where(['reset_token' => $token])->first();
    }
    
    public function SendResetLink($request){
        $data['request'] = 'forgotPassword';
        $data['name'] = $request->email;
        $data['email'] = $request->email;
        $data['email'] = $request->email;
        $data['subject'] = 'Password reset link';
        $data['link'] = (!empty($request->inquiry_id)) ? $request->inquiry_id : '';
        $res = \App\common\helpers\Utility::sendMail($data);
        $this->addToSendList($data);
        return Response::Json(['success'=>true,'message'=>'Mail sent successfully.']);
    }
    
    /**
     * get dashboard statics data
     * @return mixed
     */
    public function loadSalesUserStatics($type){
        $total = $this->user->where('role_id', $type)->where('status','!=','deleted')->count();
        $deactive = $this->user->where(['role_id'=>$type])->where('status','=','inactive')->count();
        $active = $this->user->where(['role_id'=>$type,'status'=>'active'])->count();
        $statics = ['total_salesrep'=>$total,'total_deactive'=>$deactive,'total_active'=>$active];
        return $statics;
    }
    
    /**
     * search || get list of inquiry type general
     * @param type $request
     * @return mixed
     */
    public function searchSalesUser($request,$role){
        
        $query = $this->user->where(['role_id'=>$role])->where('status','!=','deleted');
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
     * update status of a user
     * @param type $id
     * @param type $post
     * @return bool
     */
    public function toggleStatus($id,$post){
        $data = array();
         $data['status'] = $post->status;
        return $this->user->where('id', $id)->update($data);
    }
    
    /**
     * Save User.
     *
     * @param Post $post
     *
     * @return bool
     */
    public function createOrUpdate($post,$type = 3)
    {
        $password = true;
        if(!empty($post->id)){
            $this->user = $this->user->find($post->id);
        }
        $this->user->first_name  = $post->first_name;
        $this->user->last_name   = $post->last_name;
        $this->user->email       = $post->email;
        $this->user->mobile      = $post->mobile;
        $this->user->country_id       = $post->country_id; 
        if(empty($post->id)){
            $this->user->role_id = $type;
            $password = str_random(8);
            $this->user->password = bcrypt($password);
        }
        if($this->user->save()) {
            return $password;
        } else {
            return false;
        }
    }
}
