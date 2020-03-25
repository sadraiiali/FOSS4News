<?php

namespace App\Http\Requests;

use App\Report;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateReportRequest extends FormRequest
{

    public function rules()
    {
        return [
            'reason' => ['required', 'string', Rule::in(Report::$reasons)],
            'body' => 'required|string'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
