<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Common\Models\Inquiry;

class generalInquiryRequest extends FormRequest {

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
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'alternet_email' => 'nullable|email',
            'phone' => 'required_without:mobile|min:12|max:12',
            'mobile' => 'required_without:phone|min:12|max:12',
            'country_id' => 'required',
            'state' => 'required',
            'address' => 'required',
            'zipcode' => 'required|min:5|max:8',
            //'inquiry_type' => 'required_without:id',
            'website' =>'nullable|regex:'.$regex
        ];
    }

    public function messages() {
        return [
            'mobile.min' => 'The mobile number must be 10 digits.',
            'phone.min' => 'The phone number must be 10 digits.',
            'mobile.min' => 'The mobile number must be 10 digits.',
            'phone.min' => 'The phone number must be 10 digits.'
        ];
    }
}
