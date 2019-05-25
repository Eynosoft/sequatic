<?php

namespace App\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Common\Models\Inquiry;

class editUserRequest extends FormRequest {

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
            
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'mobile' => 'nullable|min:12|max:12',
            'country_id'=>'required'
        ];
    }

    public function messages() {
        return [
             'mobile.min' => 'The mobile number must be 10 digits.',
            'mobile.min' => 'The mobile number must be 10 digits.',
        ];
    }
    
}
