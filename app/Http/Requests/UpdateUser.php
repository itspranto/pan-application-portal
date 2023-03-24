<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|string|max:255',
            'mobile' => 'required',
            'address' => 'required',
            'city' => 'required',
            'pin' => 'bail|required|numeric',
            'state' => 'required',
            'shop' => 'required',
            'franchise' => 'required',
            'business' => 'required',

            'pan_number' => 'required',
            'adhar_number' => 'required'
        ];
    }
}
