<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $methodCheck = $this->method();
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

        if($methodCheck == 'PUT'){
            return [
                'name'=>['required'],
                'email'=>['required', 'email', 'unique:students'],
                'address'=>['required'],
                'course'=>['required', Rule::in($course)]
            ];


        } else if ($methodCheck == 'PATCH'){

            return [
                'name'=>['sometimes','required'],
                'email'=>['sometimes','required', 'email'],
                'address'=>['sometimes','required'],
                'course'=>['sometimes','required', Rule::in($course)]
            ];

        }
        
    }
}
