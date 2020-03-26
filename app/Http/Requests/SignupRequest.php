<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users|max:100',
            'password' => 'required|min:6|confirmed',
            'email' => 'required|email|unique:users|max:255',
            'phone_number' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9|unique:users',
            'apartment_number' => 'string|required|max:10',
            'street' => 'string|required|max:255',
            'ward' => 'string|required|max:255',
            'district' => 'string|required|max:255',
            'city' => 'string|required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('auth.namerequired'),
            'name.string' => trans('auth.namestring'),
            'name.max' => trans('auth.namemax'),
            'username.required' => trans('auth.usernamerequired'),
            'username.unique' => trans('auth.usernameunique'),
            'username.max' => trans('auth.usernamemax'),
            'email.required' => trans('auth.mailrequired'),
            'email.unique' => trans('auth.mailunique'),
            'phonenumber.required' => trans('auth.phonerequire'),
            'phonenumber.unique' => trans('auth.phoneunique'),
            'phone.not_regex' => trans('auth.phonenotregex'),
            'number.required' => trans('auth.numberrequired'),
            'street.required' => trans('auth.streetrequired'),
            'ward.required' => trans('auth.wardrequired'),
            'district.required' => trans('auth.districtrequired'),
            'city.required' => trans('auth.cityrequired'),
        ];
    }
}
