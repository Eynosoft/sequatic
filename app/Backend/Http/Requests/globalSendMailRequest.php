<?php

namespace App\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Common\Models\Inquiry;

class globalSendMailRequest extends FormRequest {

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
            'email_to' => 'required|email',
            'subject' => 'required',
            'email_body' => 'required'
        ];
    }

    public function messages() {
        return [
            //'mobile.digits' => 'The mobile number must be 10 digits.',
            //'phone.digits' => 'The phone number must be 10 digits.'
        ];
    }
    
}
