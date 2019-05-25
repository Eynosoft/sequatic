<?php
namespace App\Backend\Http\Controllers;
use Illuminate\Http\Request;
use App\Common\Repositories\Base\MasterCountryRepositoryInterface;
use App\Backend\Http\Requests\addUserRequest;
use App\Backend\Http\Requests\editUserRequest;
use App\Common\Repositories\Base\UserRepositoryInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
class SalesRepController extends Controller {
    protected $country;
    protected $user;
    CONST ROLE = 3;
    public function __construct(MasterCountryRepositoryInterface $country, UserRepositoryInterface $user) {
        $this->country = $country;
        $this->user = $user;
    }
    public function index() {
        $country = $this->country->findAll();
        return view('backend::sales_rep.index',['country'=>$country]);
    }
    public function loadSalesRep(Request $request) {
        $salesrep = $this->user->searchSalesUser($request,self::ROLE)->paginate(10);
        $html = View::make('backend::sales_rep._load-salesrep', ['salesrep' => $salesrep])->render();
        return Response::Json(['html' => $html]);
    }
    public function toggleStatus(Request $request) {
        $userModel = $this->user->find($request->id);
        if (!empty($userModel)) {
            $status = $this->user->toggleStatus($request->id, $request);
            if ($status) {
                return Response::Json(['success' => true, 'message' => 'User deleted successfully.']);
            } else {
                return Response::Json(['success' => false, 'message' => 'Something went wrong, Please try again later.']);
            }
        }
        return abort(404, 'user not found.');
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
    
    public function edit($id) {
        if ((int) $id) {
            $model = $this->user->find($id);
            if (count($model) > 0) {
                $countries = $this->country->findAll();
                 $html = View::make('backend::sales_rep._edit', ['country' => $countries, 'salesrep' => $model])->render();
                 return Response::Json(['html' => $html]);
            }
            abort(404);
        }
        abort(404);
    }
    
    /**
     * Creates pr update a inquiry.
     *
     * @return string
     */
    public function create(addUserRequest $request) {
        if ($password = $this->user->createOrUpdate($request)) {
            $data = $request;
            $data['request'] = 'new_user_creation';
            $data['subject'] = 'Welcome to Seaquatic';
            $data['password'] = $password;
            \App\common\helpers\Utility::sendMail($data);
            return Response::Json(['success' => true, 'message' => 'Success! User has been created successfully.']);
        } else {
            return Response::Json(['success' => false, 'message' => 'Woops! Something went wrong, Please try again later.']);
        }
        return redirect()->back();
    }
    public function loadSalesRepStatics(Request $request) {
        $statics = $this->user->loadSalesUserStatics(self::ROLE);
        return Response::Json($statics);
    }
    
    /**
     * Creates pr update a inquiry.
     *
     * @return string
     */
    public function update(editUserRequest $request) {
        if ($this->user->createOrUpdate($request)) {
            return Response::Json(['success' => true, 'message' => 'Success! User has been updated successfully.']);
        } else {
            return Response::Json(['success' => false, 'message' => 'Woops! Something went wrong, Please try again later.']);
        }
        return redirect()->back();
    }
}
