<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePan extends FormRequest
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
            "category" => "required",
            "date" => "bail|required|date",

            "last_name" => "required",
            "first_name" => "required",

            "father_last_name" => "required",
            "father_first_name" => "required",

            "dob" => "bail|required|date",
            "mobile" => "required",
            "gender" => "required",
            "email" => "required",

            "area" => "required",
            "city" => "required",
            "state" => "required",
            "area_pin" => "required",

            "adhar_number" => "required|numeric",
            "adhar_proof" => "bail|required|file|mimes:pdf",

            "identity_proof" => "required",
            "address_proof" => "required",
            "dob_proof" => "required",

            "pin" => "bail|required|numeric",
        ];
    }
}
