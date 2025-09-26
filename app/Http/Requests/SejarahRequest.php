<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SejarahRequest extends FormRequest
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
            'title'         => 'required',
            'keyword'       => 'required',
            'description'   => 'required',
            'content'       => 'required',
            'image_header'  => 'required',
            'image_content' => 'required',
            'publish'       => 'required',
        ];
    }
}
