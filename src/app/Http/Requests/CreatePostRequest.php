<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => 'string|required',
            'link' => 'string|required',
            'body' => 'string'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
