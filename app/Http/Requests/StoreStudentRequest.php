<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {   
        $course = [
            'Software Engineering', 
            'Law', 
            'Network Engineering', 
            'Hotel Management', 
            'Chemical Engineering',
            'Architechture',
            'Environmental Science',
            'Sport Science'

        ];


        return [
            'name'=>['required', 'string'],
            'email'=>['required','email', 'unique:students'],
            'address'=>['required', 'min:6'],
            'course'=>['required', Rule::in($course)]
        ];
    }
}
