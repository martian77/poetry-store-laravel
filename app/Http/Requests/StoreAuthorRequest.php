<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      return $this->user();

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'firstname' => 'required',
          'familyname' => 'required',
          'birthdate' => 'date|before:today',
          'deathdate' => 'date|after:birthdate|before:tomorrow',
        ];
    }

    /**
     * Overriding the default validation messages.
     *
     * @return array
     */
    public function messages()
    {
      return [
        'firstname.required' => 'Please fill out the First Name field.',
        'familyname.required' => 'Please fill out the Family Name field.',
        'birthdate.date' => 'The Date of Birth must be a valid date.',
        'birthdate.before' => 'The Date of Birth should not be in the future.',
        'deathdate.date' => 'The Date of Death must be a vaild date.',
        'deathdate.after' => 'The Date of Death should be after the Date of Birth.',
        'deathdate.before' => 'The Date of Death should not be in the future.',
      ];
    }
}
