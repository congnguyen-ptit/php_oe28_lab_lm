<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'user_id' => ['required', 'numeric'],
            'category_id' => ['required', 'numeric'],
            'publisher_id' => ['required', 'numeric'],
            'content' => ['required', 'string'],
            'description' => ['required', 'string'],
            'quantity' => ['required', 'numeric'],
            'image' => ['required', 'string'],
        ];
    }
}
