<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'email', 'unique:users', 'max:255'],
            'phone_number' => ['required', 'regex:/(0)[0-9]/', 'not_regex:/[a-z]/', 'min:9', 'unique:users'],
            'apartment_number' => ['string', 'required', 'max:10'],
            'street' => ['string', 'required', 'max:255'],
            'ward' => ['string', 'required', 'max:255'],
            'district' => ['string', 'required', 'max:255'],
            'city' => ['string', 'required', 'max:255'],
        ];
    }
}
