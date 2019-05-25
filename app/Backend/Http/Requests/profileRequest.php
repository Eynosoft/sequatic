<?php

namespace App\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Common\Models\Inquiry;
use App\common\helpers\User;

class profileRequest extends FormRequest {

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
            
            'first_name' => 'required|min:2|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required|email|unique:users,email,'.$this->user()->id,
        ];
    }

    public function messages() {
        return [
            
        ];
    }
    
}
