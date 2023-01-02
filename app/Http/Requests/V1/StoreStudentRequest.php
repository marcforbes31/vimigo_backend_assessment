<?php

namespace App\Http\Requests\V1;

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
        $staff = $this->user();
        return $staff!=null;
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
