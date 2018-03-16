<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Poem;

class StorePoemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $poem_id = $this->input('poem_id', 0);
        if ( $this->user() && ! empty( $poem_id ) ) {
          // Need to make sure that it's one of this user's poems.
          // Eventually add a permission to allow editing others.
          $poem = Poem::find($poem_id);
          return ($this->user()->id == $poem->user->id);
        }
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
            'title' => 'required|max:255',
            'body' => 'required',
            'publicationDate' => 'nullable|digits:4',
        ];
    }
}
