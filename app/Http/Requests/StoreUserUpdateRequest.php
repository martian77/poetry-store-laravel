<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class StoreUserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      $user = User::find($this->user);

      return $user && $this->user()->can('update', $user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
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
        'name.required' => 'Please complete the name field.',
        'email.required' => 'Please complete the email field.',
        'email.email' => 'Please enter a valid email address.',
      ];
    }
}
