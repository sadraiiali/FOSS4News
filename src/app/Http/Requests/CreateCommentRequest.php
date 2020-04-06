<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'body' => 'string|required'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
