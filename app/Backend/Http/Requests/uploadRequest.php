<?php

namespace App\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Common\Models\Inquiry;

class uploadRequest extends FormRequest {

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
            
            'file' => 'required|max:2048|mimes:jpeg,png,docx,xls,xlsx,pdf'
        ];
    }

    public function messages() {
        return [
            //'mobile.digits' => 'The mobile number must be 10 digits.',
            //'phone.digits' => 'The phone number must be 10 digits.'
        ];
    }
    
}
