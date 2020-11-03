<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateItemRequest extends FormRequest
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
            //
            'name'=> 'required',
            'body'=> 'required'
        ];
    }

    public function messages()
    {
        return[
            'name.required'=> 'Name Field is not meant to be empty :)',
            'body.required'=> 'Body Field is not meant to be empty :)',

        ];
    }
}
