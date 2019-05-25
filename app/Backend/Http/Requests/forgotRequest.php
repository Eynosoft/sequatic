<?php

namespace App\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Common\Models\Inquiry;

class forgotRequest extends FormRequest {

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
            'email' => 'required|email|exists:users,email'
        ];
    }

    public function messages() {
        return [
            'email.exists' => "This email does not belong to any account."
        ];
    }
    
}
