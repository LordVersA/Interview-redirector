<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkStoreRequest extends FormRequest
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
//
        return [
            "link" => "required|url",
            "label" => "required|unique:links,label",
            "status_code" => "max:3|min:3|regex:/^[1-5][0-9][0-9]$/",
            "category" => 'required',
            'is_active' => ""
        ];
    }
}
