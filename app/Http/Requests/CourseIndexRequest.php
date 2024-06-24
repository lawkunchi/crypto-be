<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseIndexRequest extends FormRequest
{
    public function authorize()
    {
        // Assuming all users can access this request
        return true;
    }

    public function rules()
    {
        return [
            'page' => 'integer|min:1',
            'limit' => 'integer|min:1|max:100',
        ];
    }
}