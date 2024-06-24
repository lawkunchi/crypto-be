<?php

namespace App\Http\Requests;

use App\Rules\UniqueUserCourse;
use Illuminate\Foundation\Http\FormRequest;

class UserCourseStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'course_id' => [
                'required',
                'integer',
                'max:1000',
            ],
        ];
    }
}
