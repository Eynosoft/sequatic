<?php

namespace App\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Common\Models\Inquiry;
use Illuminate\Support\Facades\Auth;

class resetPasswordRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    
    public function rules() {
        return [
            'password' => 'required|min:6|max:20',
            'confirm_password' => 'required|same:password|min:6|max:20'
        ];
    }

    public function messages() {
        return [
            //'mobile.digits' => 'The mobile number must be 10 digits.',
            //'phone.digits' => 'The phone number must be 10 digits.'
        ];
    }
}
